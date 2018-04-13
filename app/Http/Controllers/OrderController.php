<?php

namespace App\Http\Controllers;

use App\Classes\enums\OrderStatusEnum;
use App\Order;
use App\Tariff;
use App\Traits\order\OrderControllerHelper;
use App\User;
use App\Utils\AppUtils;
use App\Utils\OrderUtils;
use Illuminate\Http\Request;
use App\Http\Controllers\TopvisorController;

class OrderController extends Controller
{

    private static $NO_ORDER_ACCESS_ACTIONS = ['create', 'store', 'index', 'search', 'findUser', 'findOptimizer', 'loadMaintenancesByTariff'];
    private static $COMMON_ACTION = ['index', 'search', 'show', 'getToUpdateClientKeywords', 'updateClientKeywords'];

    private static $ONLY_ADMIN_ACTIONS = ['create', 'store', 'edit', 'update', 'getToAssignTechManager', 'assignTechManager'];
    private static $ONLY_TECH_MANAGER_ACTIONS = ['getToAssignChecklist', 'assignChecklist', 'getToSetCompleted', 'complete'];
    private static $ONLY_OPTIMIZER_ACTIONS = ['getToUpdateChecklistStatus', 'updateChecklistStatus'];

    protected $orderService;

    use OrderControllerHelper;

    public function __construct()
    {
        //To access any action should have staff role, exception is the list actions
        $this->middleware('checkRole:' . self::$STAFF_ROLES, ['except' => self::$COMMON_ACTION]);

        //To access common actions should have order access roles
        $this->middleware('checkRole:' . self::$ORDER_ACCESS_ROLES, ['only' => self::$COMMON_ACTION]);

        //To check order access except the corresponding list
        $this->middleware('orderAccess', ['except' => self::$NO_ORDER_ACCESS_ACTIONS]);

        //Role specific restrictions
        $this->middleware('administrator', ['only' => self::$ONLY_ADMIN_ACTIONS]);
        $this->middleware('techManager', ['only' => self::$ONLY_TECH_MANAGER_ACTIONS]);
        $this->middleware('optimizer', ['only' => self::$ONLY_OPTIMIZER_ACTIONS]);

        $this->orderService = app()->make('orderService');
    }

    public function index()
    {
        return view('admin.crud-orders.index')->with('orders', $this->orderService->getOrdersListForUser());
    }

    public function search(Request $request)
    {
        $foundOrders = $this->orderService->search($request);
        return view('admin.crud-orders.index')->with('orders', $foundOrders);
    }

    public function show($id)
    {
        $order = Order::find($id);
        return $this->withTariffsAndChecklistGroups(view('admin.crud-orders.show', compact('order', 'id')), $order);
    }


    /*---------------Start order persistence operations---------------*/

    public function create()
    {
        return $this->withTariffs(view('admin.crud-orders.create'));
    }

    public function store(Request $request)
    {
        $this->orderService->save($request);
        return back()->with('success', OrderUtils::getOrderSavedSuccessMessage());
    }

    public function update(Request $request, $id)
    {
        $this->orderService->update($request, $id);
        return redirect('orders')->with('success', OrderUtils::getOrderUpdatedSuccessMessage());
    }

    public function assignTechManager(Request $request, $id)
    {
        $this->orderService->assignTechManager($id);
        return redirect('orders')->with('success', OrderUtils::getOrderUpdatedSuccessMessage());
    }

    public function assignChecklist(Request $request, $id)
    {
        $this->orderService->assignChecklist($request, $id);
        return redirect('orders')->with('success', OrderUtils::getOrderUpdatedSuccessMessage());
    }

    public function updateChecklistStatus(Request $request, $id)
    {
        $this->orderService->updateChecklistStatus($request, $id);
        return redirect('orders')->with('success', OrderUtils::getOrderUpdatedSuccessMessage());
    }

    public function complete(Request $request, $id)
    {
        $this->orderService->setCompleted($id);
        return redirect('orders')->with('success', OrderUtils::getOrderUpdatedSuccessMessage());
    }

    public function updateClientKeywords(Request $request, $id)
    {
        $this->orderService->updateClientKeywords($request, $id);
        return redirect('orders')->with('success', OrderUtils::getOrderUpdatedSuccessMessage());
    }

    public function confirmClientKeywords(Request $request, $id)
    {
        $this->orderService->confirmClientKeywords($request, $id);
        return redirect('orders')->with('success', OrderUtils::getOrderUpdatedSuccessMessage());
    }

    public function addExceptionalChecklist(Request $request, $id)
    {
        $this->orderService->addExceptionalChecklist($request, $id);
        return redirect('orders')->with('success', OrderUtils::getOrderUpdatedSuccessMessage());
    }

    /*---------------End order persistence operations---------------*/


    /*---------------Start order retrieval operations---------------*/

    public function edit($id)
    {
        $order = $this->orderService->getForEdit($id);
        return $this->withTariffsAndChecklistGroups(view('admin.crud-orders.edit', compact('order', 'id')), $order);
    }

    public function getToAssignTechManager($id)
    {
        $order = $this->orderService->getToAssignTechManager($id);
        return $this->withTariffsAndChecklistGroups(view('admin.crud-orders.edit', compact('order', 'id')), $order);
    }

    public function getToAssignChecklist(Request $request, $id)
    {
        $order = $this->orderService->getForAssignChecklist($id);
        return $this->withHistory(view('admin.crud-orders.edit', compact('order', 'id')), $order);
    }

    public function getToUpdateChecklistStatus($id)
    {
        $order = $this->orderService->getToUpdateChecklistStatus($id);
        return $this->withHistory(view('admin.crud-orders.edit', compact('order', 'id')), $order);
    }

    public function getToSetCompleted($id)
    {
        $order = $this->orderService->getToSetCompleted($id);
        return $this->withHistory(view('admin.crud-orders.edit', compact('order', 'id')), $order);
    }

    public function getToUpdateClientKeywords($id)
    {
        $order = $this->orderService->getToUpdateClientKeywords($id);
        return $this->withHistory(view('admin.crud-orders.edit', compact('order', 'id')), $order);
    }

    public function getToConfirmClientKeywords($id)
    {
        $order = $this->orderService->getToConfirmClientKeywords($id);
        return $this->withHistory(view('admin.crud-orders.edit', compact('order', 'id')), $order);
    }

    public function getToAddExceptionalChecklist($id)
    {
        $order = $this->orderService->getToAddExceptionalChecklist($id);
        return $this->withHistory(view('admin.crud-orders.edit', compact('order', 'id')), $order);
    }

    /*---------------End order retrieval operations---------------*/


    public function findUser(Request $request)
    {
        $emailToFind = $request->get('emailToFind');
        $users = User::clients()->where('email', 'like', "%$emailToFind%")->get();
        return view('admin.crud-orders.templates.user-finder')->with('users', $users);
    }

    public function findOptimizer(Request $request)
    {
        $optimizerToFind = $request->get('optimizerToFind');
        $optimizers = User::optimizers()->where(function ($q) use ($optimizerToFind) {
            $q->where('email', 'like', "%$optimizerToFind%")
                ->orWhere('name', 'like', "%$optimizerToFind%");
        })->get();
        return view('admin.crud-orders.templates.optimizer-finder')->with('optimizers', $optimizers);
    }

    public function loadMaintenancesByTariff(Request $request)
    {
        $checklistsGroup = Tariff::find($request->get('tariff'))->checklists()->get()->groupBy('maintenance.id');
        return view('admin.crud-orders.templates.checklists.checklists-tab')->with('checklistsGroup', $checklistsGroup);
    }
}
