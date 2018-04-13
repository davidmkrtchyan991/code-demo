<?php

namespace App\Services;

use App\Maintenance;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MaintenanceService
{
    public function all()
    {
        return Maintenance::paginate(10);
    }

    public function saveKeywords($request)
    {
        $this->getKeywordsValidator($request->all())->validate();
        DB::transaction(function () use ($request) {
            $maintenance = new Maintenance();
            $maintenance->isKeywords = true;
            $maintenance->name = $request->get('name');
            $maintenance->keywords_count = $request->get('keywords_count');
            $maintenance->save();
        });
    }

    public function updateKeywords($request, $id)
    {
        $this->getKeywordsValidator($request->all())->validate();
        DB::transaction(function () use ($request, $id) {
            $maintenance = Maintenance::find($id);
            $maintenance->name = $request->get('name');
            $maintenance->keywords_count = $request->get('keywords_count');
            $maintenance->save();
        });
    }

    public function save($request)
    {
        $this->getValidator($request->all())->validate();
        DB::transaction(function () use ($request) {
            $maintenance = new Maintenance();
            $maintenance->name = $request->get('name');
            $maintenance->save();
        });
    }

    public function update($request, $id)
    {
        $this->getValidator($request->all())->validate();
        DB::transaction(function () use ($request, $id) {
            $maintenance = Maintenance::find($id);
            $maintenance->name = $request->get('name');
            $maintenance->save();
        });
    }

    public function delete($id)
    {
        $maintenance = Maintenance::find($id);
        if ($maintenance) {
            $maintenance->delete();
        }
    }


    private function getValidator($data)
    {
        return Validator::make($data, [
            'name' => 'required',
        ]);
    }

    private function getKeywordsValidator($data)
    {
        return Validator::make($data, [
            'name' => 'required',
            'keywords_count' => 'required',
        ]);
    }
}