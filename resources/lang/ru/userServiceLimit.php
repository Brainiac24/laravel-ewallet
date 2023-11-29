<?php

return [
    'backend' => [
        'title' => 'Лимиты услуг для пользователей',
        'id' => '№',
        'name' => 'Лимит',
        'service_id' => 'Имя сервиса',
        'user_id' => 'Пользователь',
        'params_json' => 'Параметры',
        'created_at' => 'Создан',
        'updated_at' => 'Изменен',
        'extend_params_json' => 'Дополнительные параметры',
        'table' => [
            'title' => 'Лимиты услуг для пользователей',
            'id' => '№',
            'name' => 'Лимит',
            'service_id' => 'Имя сервиса',
            'user_id' => 'Пользователь',
            'params_json' => 'Параметры',
            'created_at' => 'Создан',
            'updated_at' => 'Изменен',
            'extend_params_json' => 'Дополнительные параметры',
        ],
    ],
    'errors' => [
        'not_found' => 'Лимит указанного сервиса не найден.',
        'list_not_found' => 'Список лимитов сервисов не найден.',
        'balance_limit_is_reached' => 'Достигнут месячный лимит баланса',
        'day_limit_is_reached' => 'Достигнут дневной лимит сервиса',
        'week_limit_is_reached' => 'Достигнут недельный лимит сервиса',
        'month_limit_is_reached' => 'Достигнут месячный лимит сервиса',
    ],
];
