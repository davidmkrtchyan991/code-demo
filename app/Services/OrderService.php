<?php

namespace App\Services;

use App\Classes\enums\KeywordsStatusEnum;
use App\Classes\enums\OrderOperationsEnum;
use App\Classes\enums\OrderStatusEnum;
use App\ClientKeywords;
use App\Maintenance;
use App\Order;
use App\OrderChecklist;
use App\OrderChecklistHistoryRecord;
use App\OrderChecklistsItem;
use App\OrderExceptionalChecklistsItem;
use App\OrderHistoryRecord;
use App\Tariff;
use App\User;
use App\Utils\AppUtils;
use App\Utils\ChecklistItemUtils;
use App\Utils\OrderUtils;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderService
{
    private $emailService;

    public function __construct()
    {
        $this->emailService = app()->make('emailService');
    }

    public function all()
    {
        return Order::paginate(10);
    }

    public function getOrdersListForUser()
    {
        $queryBuilder = Order::existing();
        $this->applyUserFilter($queryBuilder);
        return $queryBuilder ? $queryBuilder->paginate(10) : [];
    }

    public function getForEdit($id)
    {
        $order = Order::find($id);
        $order->isEditable = true;
        $order->commitOperation = OrderOperationsEnum::UPDATE_REGISTERED;
        return $order;
    }

    public function getToAssignTechManager($id)
    {
        $order = Order::find($id);
        $order->commitOperation = OrderOperationsEnum::ASSIGN_TO_TECH_MANAGER;
        return $order;
    }

    public function getForAssignChecklist($id)
    {
        $order = Order::find($id);
        $order->isAssignChecklist = true;
        $order->commitOperation = OrderOperationsEnum::ASSIGN_TO_OPTIMIZER;
        return $order;
    }

    public function getToUpdateChecklistStatus($id)
    {
        $order = Order::find($id);
        $order->commitOperation = OrderOperationsEnum::UPDATE_CHECKLIST_STATUS;
        return $order;
    }

    public function getToSetCompleted($id)
    {
        $order = Order::find($id);
        $order->commitOperation = OrderOperationsEnum::COMPLETE;
        return $order;
    }

    public function getToUpdateClientKeywords($id)
    {
        $order = Order::find($id);
        $order->commitOperation = OrderOperationsEnum::UPDATE_CLIENT_KEYWORDS;
        return $order;
    }

    public function getToConfirmClientKeywords($id)
    {
        $order = Order::find($id);
        $order->commitOperation = OrderOperationsEnum::CONFIRM_CLIENT_KEYWORDS;
        return $order;
    }

    public function getToAddExceptionalChecklist($id)
    {
        $order = Order::find($id);
        $order->commitOperation = OrderOperationsEnum::ADD_EXCEPTIONAL_CHECKLIST;
        return $order;
    }

    public function save($request)
    {
        $this->getValidatorForStore($request->all())->validate();
        $order = new Order;
        DB::transaction(function () use ($request, $order) {
            $user = User::find($request->get('userId'));
            $order->setOrderUser($user);
            $order->fill($this->getOrderDataForStore($request->all(), $user));
            $order->setOrderTariff(Tariff::find($request->get('tariff')));
            $order->save();
            $this->addHistoryRecord($order, OrderOperationsEnum::REGISTER);
        });
        $this->emailService->sendOrderRegistration($order);
    }

    public function update($request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $order = Order::find($id);

            $this->getValidatorForUpdate($request->all())->validate();
            $order->companyName = $request->get('companyName');
            $order->domain = $request->get('domain');
            $order->mobNumber = $request->get('mobNumber');
            $order->additionalMobNumber = $request->get('additionalMobNumber');
            $order->offerNumber = $request->get('offerNumber');
            $order->comment = $request->get('comment');

            $order->startDate = Carbon::createFromFormat(AppUtils::DATE_FORMAT, $request->get('startDate'));
            $order->endDate = Carbon::createFromFormat(AppUtils::DATE_FORMAT, $request->get('endDate'));

            $order->ftpHost = $request->get('ftpHost');
            $order->ftpPort = $request->get('ftpPort');
            $order->ftpLogin = $request->get('ftpLogin');
            $order->ftpPassword = $request->get('ftpPassword');

            $order->ftpCmsUrl = $request->get('ftpCmsUrl');
            $order->ftpCmsLogin = $request->get('ftpCmsLogin');
            $order->ftpCmsPassword = $request->get('ftpCmsPassword');

            $order->setOrderTariff(Tariff::find($request->get('tariff')));

            $this->addHistoryRecord($order, OrderOperationsEnum::UPDATE_REGISTERED);
            $order->save();
        });
    }

    public function assignTechManager($id)
    {
        DB::transaction(function () use ($id) {
            $order = Order::find($id);
            $order->status = OrderStatusEnum::ASSIGNED_TO_TECH_MANAGER;
            $this->initOrderChecklists($order);
            $this->addHistoryRecord($order, OrderOperationsEnum::ASSIGN_TO_TECH_MANAGER);
            $order->save();
            return $order;
        });
    }

    public function assignChecklist($request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $this->getValidatorForAssignOptimizer($request->all())->validate();
            $order = Order::find($id);
            $order->setOrderOptimizer(User::optimizer($request->get('optimizerId'))->first());
            $order->status = OrderStatusEnum::ASSIGNED_TO_OPTIMIZER;
            $order->keywords = $request->get('keywords');

            $this->updateOrderChecklistsItems($order, $request);

            $order->save();
        });
    }

    public function updateChecklistStatus($request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $order = Order::find($id);
            $this->updateOrderChecklistsItems($order, $request);
            $order->save();
            return $order;
        });
    }

    public function setCompleted($id)
    {
        DB::transaction(function () use ($id) {
            $order = Order::find($id);
            $order->status = OrderStatusEnum::COMPLETED;
            $this->addHistoryRecord($order, OrderOperationsEnum::COMPLETE);
            $order->save();
            return $order;
        });
    }

    public function updateClientKeywords($request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $order = Order::find($id);

            collect($request->all())->each(function ($value, $paramName) use ($request) {
                if (str_contains($paramName, 'added_client_keywords-')) {
                    $keywordsId = explode('-', $paramName)[1];

                    $clientKeywords = ClientKeywords::find($keywordsId);

                    if ($clientKeywords && $clientKeywords->status != KeywordsStatusEnum::CONFIRMED) {
                        if ($value) {
                            $clientKeywords->keywords = $value;
                            $clientKeywords->status = KeywordsStatusEnum::WAITING_FOR_CONFIRMATION;
                            $clientKeywords->save();
                        } else {
                            $clientKeywords->delete();
                        }
                    }
                }
            });

            if ($request->get('client_keywords')) {
                $clientKeywords = new ClientKeywords;
                $clientKeywords->keywords = $request->get('client_keywords');
                $clientKeywords->status = KeywordsStatusEnum::WAITING_FOR_CONFIRMATION;
                $clientKeywords->setOrder($order);
                $clientKeywords->save();
            }

            $this->addHistoryRecord($order, OrderOperationsEnum::UPDATE_CLIENT_KEYWORDS);
            $order->save();
            return $order;
        });
    }

    public function confirmClientKeywords($request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $order = Order::find($id);

            collect($request->all())->each(function ($value, $paramName) use ($request) {
                if (str_contains($paramName, 'added_client_keywords_status-')) {
                    $keywordsId = explode('-', $paramName)[1];

                    $clientKeywords = ClientKeywords::find($keywordsId);
                    if ($clientKeywords && collect(KeywordsStatusEnum::ALL)->contains($value)) {
                        $clientKeywords->status = $value;
                        $clientKeywords->save();
                    }
                }
            });
            $this->addHistoryRecord($order, OrderOperationsEnum::CONFIRM_CLIENT_KEYWORDS);
            $order->save();
            return $order;
        });
    }

    public function addExceptionalChecklist($request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $order = Order::find($id);
            $this->initExceptionalChecklistItems($order, $request);
            $this->addHistoryRecord($order, OrderOperationsEnum::ADD_EXCEPTIONAL_CHECKLIST);
            $order->save();
            return $order;
        });
    }


    //-----------------------------------------------//

    public function search($request)
    {
        $queryBuilder = Order::existing();
        $this->applyUserFilter($queryBuilder);
        if ($request->get('domain')) {
            $queryBuilder = $queryBuilder->withDomain($request->get('domain'));
        }
        return $queryBuilder ? $queryBuilder->paginate(10) : [];
    }

    private function applyUserFilter($queryBuilder)
    {
        $user = AppUtils::getUser();
        if ($queryBuilder) {
            if ($user->isAdministrator()) {
                return $queryBuilder->existing();
            }
            if ($user->isTechManager()) {
                return $queryBuilder->existing();
            }
            if ($user->isOptimizer()) {
                return $queryBuilder->withOptimizer($user->id);
            }
            if ($user->isClient()) {
                return $queryBuilder->withUser($user->id);
            }
        }
        return $queryBuilder->where('id', '0');
    }

    /*--------------VALIDATORS-----------------------*/

    private
    function getValidatorForStore(array $data)
    {
        $maintenance = Maintenance::keywordsWithTariff($data['tariff'])->first();
        $keywords_count = $maintenance ? $maintenance->keywords_count : null;
        return Validator::make($data, [
            'userId' => 'required|exists:users,id',
            'tariff' => 'required|exists:tariffs,id',

            'companyName' => 'required',
            'domain' => 'required',
            'mobNumber' => 'required',
            'offerNumber' => 'required',
            'startDate' => 'required|date_format:"d/m/Y"|after:yesterday',
            'endDate' => 'required|date_format:"d/m/Y"|after:startDate',
            'keywords' => "keywords_count:$keywords_count",
        ]);
    }


    private
    function getValidatorForUpdate(array $data)
    {
        $maintenance = Maintenance::keywordsWithTariff($data['tariff'])->first();
        $keywords_count = $maintenance ? $maintenance->keywords_count : null;
        return Validator::make($data, [
            'tariff' => 'required|exists:tariffs,id',

            'companyName' => 'required',
            'domain' => 'required',
            'mobNumber' => 'required',
            'offerNumber' => 'required',
            'startDate' => 'required|date_format:"d/m/Y"|after:yesterday',
            'endDate' => 'required|date_format:"d/m/Y"|after:startDate',
            'keywords' => "keywords_count:$keywords_count",
        ]);
    }

    private function getValidatorForAssignOptimizer(array $data)
    {
        return Validator::make($data, [
            'optimizerId' => 'required|is_optimizer',
        ]);
    }

    private
    function getValidatorForClientKeywordUpdate(array $data, $order)
    {
        $maintenance = Maintenance::keywordsWithTariff($order->tariff->id)->first();
        $keywords_count = $maintenance->keywords_count - OrderUtils::getOrderKeywordsCount($order);
        return Validator::make($data, [
            'keywords' => "keywords_count:$keywords_count",
        ]);
    }

    private
    function getOrderDataForStore(array $data, $user)
    {
        return [
            'mobNumber' => $data['mobNumber'],
            'companyName' => $data['companyName'],
            'email' => $user->email,
            'userName' => $user->name,
            'userSurname' => $user->surname,
            'domain' => $data['domain'],
            'additionalMobNumber' => $data['additionalMobNumber'],
            'comment' => $data['comment'],
            'offerNumber' => $data['offerNumber'],
            'keywords' => $data['comment'],
            'startDate' => Carbon::createFromFormat(AppUtils::DATE_FORMAT, $data['startDate']),
            'endDate' => Carbon::createFromFormat(AppUtils::DATE_FORMAT, $data['endDate']),

            'ftpHost' => $data['ftpHost'],
            'ftpPort' => $data['ftpPort'],
            'ftpLogin' => $data['ftpLogin'],
            'ftpPassword' => $data['ftpPassword'],
            'ftpCmsUrl' => $data['ftpCmsUrl'],
            'ftpCmsLogin' => $data['ftpCmsLogin'],
            'ftpCmsPassword' => $data['ftpCmsPassword']
        ];
    }

    /*--------------END VALIDATORS-----------------------*/

    private function initExceptionalChecklistItems($order, $request)
    {
        collect($request['exceptional-items'])->each(function ($name, $key) use ($order, $request) {
            if ($name) {
                $checklistItem = new OrderExceptionalChecklistsItem();
                $checklistItem->name = $name;
                $checklistItem->setOrder($order);
                $checklistItem->save();
            }
        });
    }

    private function initOrderChecklists($order, $request = null)
    {
        $order->checklists()->delete();
        $order->tariff->checklists()->get()->each(function ($checklist, $i) use ($order) {
            $orderChecklist = new OrderChecklist();
            $orderChecklist->setMaintenance($checklist->maintenance);
            $orderChecklist->setOrder($order);
            $orderChecklist->save();

            $checklist->items->each(function ($checklistItem, $i1) use ($orderChecklist) {
                $orderChecklistItem = new OrderChecklistsItem;
                $orderChecklistItem->name = $checklistItem->name;
                $orderChecklistItem->setOrderChecklist($orderChecklist);
                $orderChecklist->items()->save($orderChecklistItem);
            });
        });
    }

    private function updateOrderChecklistsItems($order, $request)
    {
        $statusesMapping = AppUtils::buildMapByDelimiter($request->get('checklist-items-statuses'));

        $record = $this->addHistoryRecord($order, OrderOperationsEnum::ASSIGN_TO_OPTIMIZER);

        $order->checklists->each(function ($checklist, $i) use ($request, $statusesMapping, $order, $record) {
            $checklist->items->each(function ($checklistItem, $i1) use ($request, $statusesMapping, $order, $record) {
                $newStatus = $statusesMapping->get($checklistItem->id);
                $statusesConfig = ChecklistItemUtils::getStatusesConfig($checklistItem);
                if ($newStatus && $newStatus != $checklistItem->status && $statusesConfig->get('operations') && collect($statusesConfig->get('operations'))->contains($newStatus)) {
                    $checklistItem->status = $newStatus;
                    $this->addChecklistHistoryRecord($checklistItem->name, $checklistItem->status, $record);
                    $checklistItem->save();
                }
            });
        });
    }

    private function addHistoryRecord($order, $operation, $comment = null)
    {
        $user = AppUtils::getUser();

        $record = new OrderHistoryRecord();

        $record->operation = $operation;
        $record->comment = $comment;
        $record->setOrder($order);
        $record->setUser($user);
        $record->save();

        return $record;
    }

    private function addChecklistHistoryRecord($name, $status, $record)
    {
        $checklistRecord = new OrderChecklistHistoryRecord();
        $checklistRecord->newStatus = $status;
        $checklistRecord->itemName = $name;
        $checklistRecord->setOrderHistoryRecord($record);
        $checklistRecord->save();
    }
}