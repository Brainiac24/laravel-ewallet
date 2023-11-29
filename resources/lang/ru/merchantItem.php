<?php
return [
    'backend' => [
        'title' => 'Мерчант пункты',
        'id' => 'ID',
        'name' => 'Мерчант пункт',
        'account_number' => 'Код/счет АБС',
        'param_account_acc' => 'Код/счет параметра',
        'address' => 'Адрес',
        'phone' => 'Номер телефона',
        'is_active' => 'Статус',
        'merchant_id' => 'Мерчант',
        'account_id' => 'Счет',
        'created_at' => 'Создан',
        'updated_at' => 'Изменен',
        'qr_code_photo' => 'QR - фото',
        'qr_code_text' => 'QR - текст',
        'email' => 'Почта',
        'hash'=>'Статус хэш кода',
        'table' => [
            'title' => 'Мерчант пункты',
            'id' => 'ID',
            'name' => 'Мерчант пункт',
            'merchant_id' => 'Мерчант',
            'address' => 'Адрес',
            'phone' => 'Номер телефона',
            'is_active' => 'Статус',
            'created_at' => 'Создан',
            'updated_at' => 'Изменен',
            'email' => 'Почта',
        ],
    ],
    'errors' => [
        'not_found' => 'Мерчант найден.',
    ],
    'buttons'=>[
        'generatHash'=>'Генерировать хэш код',
        'downloadSettingsJson'=>'Скачать настройки кассы',
    ],
    'alert'=>[
        0=>'Хэш код кассы не сгенерирован',
        1=>'Хэш код кассы уже сгенерирован',
        'empty_hash_or_login'=>'Логин или хэш не сгенерирован, надо сперва сгенерировать хэш и логин!',
    ]
];
