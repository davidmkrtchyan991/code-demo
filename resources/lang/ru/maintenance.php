<?php

use App\Classes\enums\MaintenanceEnum;

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

    'add.label'=>'Добавить категорию',
    'list.label'=>'Список категорий',
    'add.keywords.label'=>'Добавить категорию для ключевых слов',
    'type.' . MaintenanceEnum::SECURITY . '.label' => 'безопасность сайта',
    'type.' . MaintenanceEnum::OPTIMIZATION . '.label' => 'оптимизация сайта',
    'type.' . MaintenanceEnum::KEY_WORDS . '.label' => 'до :count ключевых слов',
    'type.' . MaintenanceEnum::TEXT_UNIQUENESS . '.label' => 'уникальные тексты',
    'type.' . MaintenanceEnum::CONTEXTUAL_ADVERTISING . '.label' => 'контекстная реклама',
    'type.' . MaintenanceEnum::REPUTATION_MANAGEMENT . '.label' => 'управление репутацией',
    'type.' . MaintenanceEnum::IMAGES_UNIQUENESS . '.label' => 'уникальные фотографии',
    'type.' . MaintenanceEnum::USABILITY_IMPROVEMENT . '.label' => 'улучшение юзабилити',
    'type.' . MaintenanceEnum::ADDITIONAL_STRATEGY . '.label' => 'дополнительная стратегия',
    'type.' . MaintenanceEnum::MOBILE_TRAFFIC_COVERAGE . '.label' => 'охват мобильного трафика',

    'type.' . MaintenanceEnum::SOCIAL_MANAGEMENT . '.label' => 'Продвижение в социальных сетях',
    'type.' . MaintenanceEnum::PHOTO_VIDEO . '.label' => 'Фото-видео съемка',
    'type.' . MaintenanceEnum::MOBILE_APP_DEVELOPMENT . '.label' => 'Разработка мобильных приложений',

];
