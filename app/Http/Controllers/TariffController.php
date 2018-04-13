<?php

namespace App\Http\Controllers;

use App\Maintenance;
use App\Services\TariffService;
use App\Tariff;
use Illuminate\Http\Request;

class TariffController extends Controller
{
    private $tariffService;

    public function __construct()
    {
        $this->middleware('administrator');
        $this->tariffService = app()->make(TariffService::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.crud-tariff.index')->with('tariffs', $this->tariffService->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->withMaintenances(view('admin.crud-tariff.create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->tariffService->save($request);
        return back()->with('success', "Saved");
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tariff = Tariff::find($id);
        return $this->withMaintenances(view('admin.crud-tariff.edit', compact('tariff', 'id')));
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
        $this->tariffService->update($request, $id);
        return back()->with('success', "Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->tariffService->delete($id);
        return back()->with('success', "Deleted");
    }

    private function withMaintenances($view)
    {
        return $view->with('maintenances', Maintenance::all());
    }
}
