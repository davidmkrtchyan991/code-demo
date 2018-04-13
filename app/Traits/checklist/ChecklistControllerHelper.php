<?php

namespace App\Traits\checklist;


use App\Maintenance;
use App\Tariff;

trait ChecklistControllerHelper
{

    protected function withMaintenances($view)
    {
        return $view->with('maintenances', Maintenance::all());
    }

    protected function withTariffs($view)
    {
        return $view->with('tariffs', Tariff::all());
    }

    protected function withMaintenancesAndTariffs($view)
    {
        return $this->withTariffs($this->withMaintenances($view));
    }

}