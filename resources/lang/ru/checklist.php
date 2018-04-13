<?php

use \App\Classes\enums\OrderStatusEnum;
use \App\Classes\enums\ChecklistItemStatusEnum;

return [


    'default.label' => 'Чек лист',
    'status.label' => 'Статус',
    'add.items.label' => 'Добавить пункты к чеклистам',
    'change.statuses.label' => 'Изменить статусы на: ',
    'exceptional.label' => 'Форс мажорные пункты',
    'tariff.label' => 'Тарифный план',
    'tariffs.label' => 'Тарифные планы',
    'picker.label' => 'Выберите категорию для показа чеклистов',

    'item.status.' . ChecklistItemStatusEnum::WAITING_TO_BE_ASSIGNED . '.label' => 'Зарегистрирован',
    'item.status.' . ChecklistItemStatusEnum::ASSIGNED . '.label' => 'Назначен',
    'item.status.' . ChecklistItemStatusEnum::DONE . '.label' => 'Выполнен',

    'history.label' => 'Изменения по заказу',
    'item.history.label' => 'Изменения по чеклистам',
    'item.history.record.message' => 'Статус задания "<b>:name</b>" был изменен на "<b>:status</b>"'
];
