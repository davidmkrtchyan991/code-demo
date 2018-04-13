<?php

use App\Classes\enums\TariffEnum;

return [

    /*
    |--------------------------------------------------------------------------
    | Custom Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'price.label'=>'Цена',
    'add.label'=>'Добавить тариф',
    'list.label'=>'Список тарифов',
    TariffEnum::BASE . ".label" => 'Базовый',
    TariffEnum::MEDIUM . ".label" => 'Средний',
    TariffEnum::PRO . ".label" => 'Про',

];
