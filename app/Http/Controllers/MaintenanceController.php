<?php

namespace App\Http\Controllers;

use App\Maintenance;
use App\Services\MaintenanceService;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{

    private $maintenanceService;

    public function __construct()
    {
        $this->middleware('administrator');
        $this->maintenanceService = app()->make(MaintenanceService::class);
    }

    //--------Actions for keywords maintenance crud-------------------//
    public function createKeywords()
    {
        return view('admin.crud-maintenance.keywords.create');
    }

    public function saveKeywords(Request $request)
    {
        $this->maintenanceService->saveKeywords($request);
        return back()->with('success', "Saved");
    }

    public function editKeywords($id)
    {
        $maintenance = Maintenance::find($id);
        return view('admin.crud-maintenance.keywords.edit', compact('maintenance', 'id'));
    }

    public function updateKeywords(Request $request, $id)
    {
        $this->maintenanceService->updateKeywords($request, $id);
        return back()->with('success', "Updated");
    }

    /////////////////////////////
    public function index()
    {
        return view('admin.crud-maintenance.index')->with('maintenances', $this->maintenanceService->all());
    }

    public function create()
    {
        return view('admin.crud-maintenance.create');
    }

    public function store(Request $request)
    {
        $this->maintenanceService->save($request);
        return back()->with('success', "Saved");
    }

    public function show(Maintenance $maintenance)
    {
        return view('admin.crud-orders.show', compact('order', 'id'));
    }


    public function edit($id)
    {
        $maintenance = Maintenance::find($id);
        return view('admin.crud-maintenance.edit', compact('maintenance', 'id'));
    }

    public function update(Request $request, $id)
    {
        $this->maintenanceService->update($request, $id);
        return back()->with('success', "Updated");
    }

    public function destroy($id)
    {
        $this->maintenanceService->delete($id);
        return back()->with('success', "Deleted");
    }
}
