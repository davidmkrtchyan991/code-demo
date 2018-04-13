<?php

namespace App\Http\Controllers;

use App\Classes\enums\OrderStatusEnum;
use App\Classes\enums\RoleEnum;
use App\Http\Requests\StatisticsRequest;
use App\Tariff;

class StatisticsController extends Controller
{

    protected $statisticsService;

    public function __construct()
    {
        $this->middleware('checkRole:' . RoleEnum::ROLE_TECHNICAL_MANAGER . ',' . RoleEnum::ROLE_ADMINISTRATOR);
        $this->statisticsService = app()->make('statisticsService');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\Request $request
     */
    public function index(StatisticsRequest $request)
    {
        return $this->viewWithModels($request);
    }


    public function filter(StatisticsRequest $request)
    {
        return $this->viewWithModels($request, true);
    }

    private function viewWithModels(StatisticsRequest $request, $doFilter = false)
    {
        $view = $this->withOrderStatuses(view('admin.statistics.index'));
        $view = $this->withTariffs($view);
        $view = $view->with('request', $request);
        if ($doFilter) {
            $result = $this->statisticsService->filter($request);
            $view = $view->with('filteredResults', $result);
            $view = $view->with('success', __('statistics.order.success.message', ['count' => $result->count()]));
        }
        return $view;
    }

    private function withOrderStatuses($view)
    {
        return $view->with('orderStatuses', OrderStatusEnum::all());
    }

    private function withTariffs($view)
    {
        return $view->with('tariffs', Tariff::all());
    }
}
