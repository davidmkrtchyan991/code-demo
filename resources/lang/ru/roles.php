<?php

use App\Classes\enums\RoleEnum;

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    RoleEnum::ROLE_ADMINISTRATOR . ".label" => 'Администратор',
    RoleEnum::ROLE_TECHNICAL_MANAGER . ".label" => 'Менеджер технической поддержки',
    RoleEnum::ROLE_OPTIMIZER . ".label" => 'Оптимизатор',
    RoleEnum::ROLE_CLIENT . ".label" => 'Клиент',
];
