<?php

namespace App\Http\Controllers;

use App\Checklist;
use App\Traits\checklist\ChecklistControllerHelper;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{

    use ChecklistControllerHelper;

    protected $checklistService;

    public function __construct()
    {
        $this->middleware('administrator');
        $this->checklistService = app()->make('checklistService');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $checklists = Checklist::paginate(5);
        return view('admin.crud-checklists.index', compact('checklists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->withMaintenancesAndTariffs(view('admin.crud-checklists.create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->checklistService->save($request);
        return back()->with('success', 'Checklist has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $checklist = Checklist::find($id);
        return view('admin.crud-checklists.show', compact('checklist', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $checklist = $this->checklistService->getForEdit($id);
        return $this->withMaintenancesAndTariffs(view('admin.crud-checklists.edit', compact('checklist', 'id')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->checklistService->update($request, $id);
        return redirect('admin/checklists')->with('success', 'Checklist has been updated');
    }
}
