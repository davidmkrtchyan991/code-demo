<?php

namespace App\Classes\enums;

abstract class RoleEnum extends Enum
{
    const ROLE_ADMINISTRATOR = "ROLE_ADMINISTRATOR";
    const ROLE_TECHNICAL_MANAGER = "ROLE_TECHNICAL_MANAGER";
    const ROLE_OPTIMIZER = "ROLE_OPTIMIZER";

    const ROLE_CLIENT = "ROLE_CLIENT";

    const STAFF_ROLES = [self::ROLE_ADMINISTRATOR, self::ROLE_TECHNICAL_MANAGER, self::ROLE_OPTIMIZER];

    static function getAssignableRoles()
    {
        return [self::ROLE_TECHNICAL_MANAGER, self::ROLE_OPTIMIZER, self::ROLE_CLIENT];
    }

    static function getALLRoles()
    {
        return array_merge(self::STAFF_ROLES, [self::ROLE_CLIENT]);
    }
}