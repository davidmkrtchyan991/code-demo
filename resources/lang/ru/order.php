<?php

use \App\Classes\enums\OrderStatusEnum;
use \App\Classes\enums\OrderOperationsEnum;
use \App\Classes\enums\KeywordsStatusEnum;

return [

    'label' => 'Заказ',
    'saved.message' => 'Заказ зарегистрирован',
    'updated.message' => 'Заказ обновлен',
    'ftp.details.label' => 'Детали FTP доступа',
    'list.label' => 'Заказы',
    'tariff.label' => 'Тарифный план',
    'status.label' => 'Статус',
    'domain.label' => 'Домен',
    'registrationDate.label' => 'Дата/время регистрации',
    'startDate.label' => 'Дата от:',
    'endDate.label' => 'До',
    'ftpHost.label' => 'Хостинг',
    'ftpPort.label' => 'Порт',
    'ftpLogin.label' => 'Логин',
    'ftpPassword.label' => 'Пароль',
    'ftpCmsUrl.label' => 'Ссылка админ. панели (CMS)',
    'ftpCmsLogin.label' => 'Логин админ. панели (CMS)',
    'ftpCmsPassword.label' => 'Пароль админ. панели (CMS)',
    'status.' . OrderStatusEnum::REGISTERED . '.label' => 'Зарегистрирован',
    'status.' . OrderStatusEnum::ASSIGNED_TO_TECH_MANAGER . '.label' => 'На рассмотрении',
    'status.' . OrderStatusEnum::ASSIGNED_TO_OPTIMIZER . '.label' => 'Назначен оптимизатору',
    'status.' . OrderStatusEnum::COMPLETED . '.label' => 'Выполнен',

    'operation.' . OrderOperationsEnum::REGISTER . '.label' => 'Регистрация',
    'operation.' . OrderOperationsEnum::UPDATE_REGISTERED . '.label' => 'Обновить',
    'operation.' . OrderOperationsEnum::ASSIGN_TO_TECH_MANAGER . '.label' => 'На рассмотрение',
    'operation.' . OrderOperationsEnum::ASSIGN_TO_OPTIMIZER . '.label' => 'Назначить оптимизатора/чеклисты',
    'operation.' . OrderOperationsEnum::ADD_EXCEPTIONAL_CHECKLIST . '.label' => 'Форс мажорный пункт',
    'operation.' . OrderOperationsEnum::UPDATE_CHECKLIST_STATUS . '.label' => 'Обновить',
    'operation.' . OrderOperationsEnum::UPDATE_CLIENT_KEYWORDS . '.label' => 'Обновить ключевые слова',
    'operation.' . OrderOperationsEnum::CONFIRM_CLIENT_KEYWORDS . '.label' => 'Подтвердить ключевые слова',
    'operation.' . OrderOperationsEnum::COMPLETE . '.label' => 'Закрыть',

    'keywords.status.' . KeywordsStatusEnum::WAITING_FOR_CONFIRMATION . '.label' => 'Ожидается подтверждение',
    'keywords.status.' . KeywordsStatusEnum::CONFIRMED . '.label' => 'Подтверждено',

    'history.operation.done.message' => 'Пользователь "<b>:name</b>" с ролью "<b>:role</b>" выполнил операцию "<b>:operation</b>" ',
    'history.recents.label' => 'Последние действия',
    'history.recents.record.main.message' => 'Выполнена операция "<b>:operation</b>"',
    'history.recents.record.userInfo.message' => ':dateTime, Исполнитель: "<b>:name</b>", Роль: "<b>:role</b>"',

    'charts.details.label' => 'Статистика по чеклистам',
    'all.statistics.label' => 'Статистика по заказам',

];
