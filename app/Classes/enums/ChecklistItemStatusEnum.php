<?php

namespace App\Classes\enums;

use Illuminate\Support\Facades\Lang;

abstract class ChecklistItemStatusEnum extends Enum
{
    const WAITING_TO_BE_ASSIGNED = "WAITING_TO_BE_ASSIGNED";
    const ASSIGNED = "ASSIGNED";
    const DONE = "DONE";

    public static function alreadyAssignedStatuses()
    {
        return [self::ASSIGNED, self::DONE];
    }

    public static function getTranslation($status)
    {
        return Lang::get("checklist.item.status.".$status.".label");
    }
}