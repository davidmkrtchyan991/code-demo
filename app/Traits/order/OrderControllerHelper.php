<?php

namespace App\Traits\order;


use App\Classes\enums\RoleEnum;
use App\Tariff;

trait OrderControllerHelper
{

    private static $STAFF_ROLES = RoleEnum::ROLE_ADMINISTRATOR . ',' . RoleEnum::ROLE_TECHNICAL_MANAGER . ',' . RoleEnum::ROLE_OPTIMIZER;
    private static $ORDER_ACCESS_ROLES = RoleEnum::ROLE_ADMINISTRATOR . ',' . RoleEnum::ROLE_TECHNICAL_MANAGER . ',' . RoleEnum::ROLE_OPTIMIZER . ',' . RoleEnum::ROLE_CLIENT;

    protected function withTariffs($view)
    {
        $view->with('tariffs', Tariff::all());
        return $view;
    }

    protected function withTariffsAndChecklistGroups($view, $order)
    {
        $this->withTariffs($view);
        $view->with('checklistsGroup', $order->tariff->checklists()->get()->groupBy('maintenance.id'));
        $view->with('history', $order->history);
        return $view;
    }

    protected function withHistory($view, $order)
    {
        return $view->with('history', $order->history);
    }

}