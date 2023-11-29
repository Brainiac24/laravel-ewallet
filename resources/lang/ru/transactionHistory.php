<?php
/**
 * Created by PhpStorm.
 * User: D_Mamadjonov
 * Date: 22/09/2017
 * Time: 15:46
 */

return[
    'backend' => [
        'id'=>'№ в истории',
        'transaction_id' => 'ID',
        'title' => 'Истории транзакций',
        'title_current' => 'История данной транзакций',
        'from_account_id' => 'Плательщик',
        'session_number'=>'Сессия',
        'to_account_id'=>'Получатель',
        'service_id'=>'Сервис',
        'amount'=>'Сумма начисления',
        'amount_all'=>'Общяя сумма списания',
        'params_json'=>'Доп. параметры',
        'transaction_type_id'=>'Тип транзакции',
        'finished_at'=>'Закончен',
        'next_try_at'=>'Следующая попытка',
        'created_by_user_id'=>'Создатель',
        'transaction_status_id'=>'Статус',
        'transaction_status_detail_id'=>'Детальный статус',
        'try_count'=>'Кол. попыток',
        'flag'=>'Флаги',
        'comment'=>'Комментарии',
        'parent_id'=>'Родитель',
        'currency_rate_value'=>'Курс на момент начисления',
        'currency_iso_name'=>'Валюта',
        'account_balance'=>'Баланс на момент начисления',
        'request'=>'Запрос',
        'response'=>'Ответ',
        'created_at'=>'Создан',
        'updated_at'=>'Изменен',
        'table' => [
            'id'=>'№ в истории',
            'transaction_id' => 'ID',
            'from_account_id' => 'Плательщик',
            'sms_confirm_try_at' => 'Подтвержден',
            'session_number'=>'Сессия',
            'to_account_id'=>'Получатель',
            'service_id'=>'Сервис',
            'amount'=>'Зачислено',
            'amount_all'=>'Списано',
            'commission'=>'Коммисия',
            'params_json'=>'Номер/Счет',
            'transaction_type_id'=>'Тип транзакции',
            'finished_at'=>'Закончен',
            'next_try_at'=>'Следующая попытка',
            'created_by_user_id'=>'Создатель',
            'transaction_status_id'=>'Статус',
            'transaction_status_detail_id'=>'Детальный статус',
            'try_count'=>'Кол. попыток',
            'flag'=>'Флаги',
            'comment'=>'Комментарии',
            'parent_id'=>'Родитель',
            'currency_rate_value'=>'Курс',
            'currency_iso_name'=>'Валюта',
            'account_balance'=>'Баланс',
            'request'=>'Запрос',
            'response'=>'Ответ',
            'created_at'=>'Создан',
            'updated_at'=>'Изменен',
        ]
    ]
];