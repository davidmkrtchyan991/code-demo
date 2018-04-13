<?php

namespace App\Traits\auth;

use App\Classes\enums\RoleEnum;
use App\Role;
use Illuminate\Support\Facades\Validator;

trait UserRoleCheckerHelper
{
    protected function isAuthPassed($role)
    {
        return auth()->check() && auth()->user()->hasRole($role);
    }
}