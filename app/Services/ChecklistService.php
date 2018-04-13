<?php

namespace App\Services;

use App\Checklist;
use App\Maintenance;
use App\ChecklistItem;
use App\Tariff;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ChecklistService
{

    public function all()
    {
        return Checklist::all();
    }

    public function save($request)
    {
        $this->getValidatorForSave($request->all())->validate();

        DB::transaction(function () use ($request) {
            $maintenance = Maintenance::find($request->get('maintenance'));

            $checklist = new Checklist;
            $checklist->setChecklistMaintenance($maintenance);
            $checklist->save();

            $checklist->tariffs()->sync(collect($request['tariff']));

            if (!$maintenance->isKeywords()) {
                collect($request['prop'])->each(function ($name, $key) use ($checklist) {
                    if ($name) {
                        $item = new ChecklistItem;
                        $item->name = $name;
                        $item->setChecklist($checklist);
                        $item->save();
                    }
                });
            }
        });
    }

    public function getForEdit($id)
    {
        $checklist = Checklist::find($id);
        $checklist->isEditable = true;
        return $checklist;
    }

    public function update($request, $id)
    {
        $this->getValidatorForUpdate($request->all())->validate();

        DB::transaction(function () use ($request, $id) {
            $checklist = Checklist::find($id);
            $checklist->items()->delete();

            $checklist->tariffs()->sync(collect($request['tariff']));

            collect($request['prop'])->each(function ($name, $key) use ($checklist) {
                if ($name) {
                    $item = new ChecklistItem;
                    $item->name = $name;
                    $item->setChecklist($checklist);
                    $item->save();
                }
            });
        });

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function getValidatorForSave(array $data)
    {
        return Validator::make($data, [
            'maintenance' => 'required|exists:maintenances,id',
            'tariff.*' => 'required|exists:tariffs,id',
            'prop.*' => 'max:255',
        ]);
    }

    private function getValidatorForUpdate(array $data)
    {
        return Validator::make($data, [
            'tariff.*' => 'required|exists:tariffs,id',
            'prop.*' => 'max:255',
        ]);
    }
}