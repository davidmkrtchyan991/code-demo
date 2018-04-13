<?php

namespace App\Services;

use App\Checklist;
use App\Maintenance;
use App\ChecklistItem;
use App\Order;
use App\Tariff;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TariffService
{

    public function all()
    {
        return Tariff::all();
    }

    public function save($request)
    {
        $this->getValidatorForSave($request->all())->validate();

        DB::transaction(function () use ($request) {
            $tariff = new Tariff();
            $tariff->name = $request->get('name');
            $tariff->price = $request->get('price');
            $tariff->maintenances()->sync(collect($request['maintenances']));

            $tariff->save();
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
            $tariff = Tariff::find($id);
            $tariff->name = $request->get('name');
            $tariff->price = $request->get('price');

            $tariff->maintenances()->sync(collect($request['maintenances']));

            $tariff->save();
        });
    }

    public function delete($id)
    {
        $tariff = Tariff::find($id);
        if ($tariff) {
            $tariff->delete();
        }
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
            'name' => 'max:255|unique:tariffs',
//            'prop.*' => 'max:255',
        ]);
    }

    private function getValidatorForUpdate(array $data)
    {
        return Validator::make($data, [
            'name' => 'max:255|unique:tariffs',
//            'prop.*' => 'max:255',
        ]);
    }
}