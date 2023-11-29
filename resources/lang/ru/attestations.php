<?php

return [
    'backend' => [
        'attestation' => 'Аттестация',
        'code' => 'Код',
        'display_name' => 'Название',
        'description' => 'Описание',
        'permission' => 'Доступы',
        'day_limit' => 'Ежедневный лимит',
        'week_limit' => 'Еженедельный лимит',
        'month_limit' => 'Ежемесячный лимит',
        'balance' => 'Лимит остатка',

        'table' => [
            'code' => 'Код',
            'name' => 'Название',
            'day_limit' => 'Ежедневный лимит',
            'week_limit' => 'Еженедельный лимит',
            'month_limit' => 'Ежемесячный лимит',
            'balance' => 'Лимит остатка',
            'created_at' => 'Создан',
            'updated_at' => 'Изменен',
        ],
    ], 
    'errors' => [
        'not_found' => 'Аттестат не найден.',
        'list_not_found' => 'Список аттестатов не найдены.',
        'balance_limit_is_reached' => 'Достигнут месячный лимит баланса',
        'day_limit_is_reached' => 'Достигнут дневной лимит операции. Доступный лимит: :attribute.',
        'week_limit_is_reached' => 'Достигнут недельный лимит операции. Доступный лимит: :attribute.',
        'month_limit_is_reached' => 'Достигнут месячный лимит операции. Доступный лимит: :attribute.',
        'not_allowed' => 'Доступ запрещён',
        'not_identified_not_allowed' => 'Получатель должен иметь статус: Идентифицированный',
    ],
];
