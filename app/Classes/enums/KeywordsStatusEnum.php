<?php

namespace App\Classes\enums;

abstract class KeywordsStatusEnum extends Enum
{
    const WAITING_FOR_CONFIRMATION = "WAITING_FOR_CONFIRMATION";
    const CONFIRMED = "CONFIRMED";

    const ALL = [self::WAITING_FOR_CONFIRMATION, self::CONFIRMED];
}