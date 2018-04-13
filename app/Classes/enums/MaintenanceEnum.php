<?php

namespace App\Classes\enums;

use Illuminate\Support\Facades\Lang;

abstract class MaintenanceEnum extends Enum
{
    const SECURITY = "SECURITY";
    const OPTIMIZATION = "OPTIMIZATION";
    const KEY_WORDS = "KEY_WORDS";
    const TEXT_UNIQUENESS = "TEXT_UNIQUENESS";
    const CONTEXTUAL_ADVERTISING = "CONTEXTUAL_ADVERTISING";
    const REPUTATION_MANAGEMENT = "REPUTATION_MANAGEMENT";
    const IMAGES_UNIQUENESS = "IMAGES_UNIQUENESS";
    const USABILITY_IMPROVEMENT = "USABILITY_IMPROVEMENT";
    const ADDITIONAL_STRATEGY = "ADDITIONAL_STRATEGY";
    const MOBILE_TRAFFIC_COVERAGE = "MOBILE_TRAFFIC_COVERAGE";

    const SOCIAL_MANAGEMENT = "SOCIAL_MANAGEMENT";
    const PHOTO_VIDEO = "PHOTO_VIDEO";
    const MOBILE_APP_DEVELOPMENT = "MOBILE_APP_DEVELOPMENT";


    public static function getTranslation($maintenance, $count = null)
    {
        if ($count) {
            return Lang::get('maintenance.type.' . $maintenance . '.label', ['count' => $count]);
        } else {
            return Lang::get('maintenance.type.' . $maintenance . '.label');
        }
    }
}