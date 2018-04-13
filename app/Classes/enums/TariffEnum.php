<?php

namespace App\Classes\enums;

use Illuminate\Support\Facades\Lang;

abstract class TariffEnum extends Enum
{
    const BASE = "BASE";
    const MEDIUM = "MEDIUM";
    const PRO = "PRO";

    public static function getTranslation($tariff)
    {
        return Lang::get('tariff.' . $tariff . '.label');
    }
}