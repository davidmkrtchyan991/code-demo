<?php

namespace App\Classes\enums;

use Illuminate\Support\Facades\Lang;

abstract class OrderStatusEnum extends Enum
{
    const REGISTERED = "REGISTERED";
    const ASSIGNED_TO_TECH_MANAGER = "ASSIGNED_TO_TECH_MANAGER";
    const ASSIGNED_TO_OPTIMIZER = "ASSIGNED_TO_OPTIMIZER";
    const COMPLETED = "COMPLETED";

    public static function all()
    {
        return [self::REGISTERED, self::ASSIGNED_TO_TECH_MANAGER, self::ASSIGNED_TO_OPTIMIZER, self::COMPLETED];
    }

    public static function getTranslation($status)
    {
        return Lang::get('order.status.' . $status . '.label');
    }
}