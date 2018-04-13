<?php

namespace App\Classes\enums;

abstract class StatisticsTypeEnum extends Enum
{
    const ORDERS = "ORDERS";
    const CLIENTS = "CLIENTS";

    public static function all()
    {
        return [self::ORDERS, self::CLIENTS];
    }
}