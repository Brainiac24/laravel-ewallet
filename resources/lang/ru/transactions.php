<?php
/**
 * Created by PhpStorm.
 * User: D_Mamadjonov
 * Date: 22/09/2017
 * Time: 15:46
 */

return [
    'backend' => [
        'transactions' => 'Транзакции',
        'created_at' => 'Начало платежа',
        'updated_at' => 'Дата изменения',
        'finished_at' => 'Платеж проведен',
        'merchant' => 'Мерчант',
        'gateway' => 'Шлюз',
        'flag' => 'Флаг',
        'try_count' => 'Количество попыток',
        'comment' => 'Комментарий',
        'gateway_id' => 'Шлюз',
        'transaction_status_id' => 'Статус',
        'transaction_status_code_id' => 'Код',
        'next_try_at' => 'Следующая попытка в ',
        'invoice' => 'Выставленные счета',
        'session_in' => 'Сессия IN',
        'session_out' => 'Сессия OUT',
        'account' => 'Номер',
        'amount' => 'Cумма',
        'сomment' => 'Комментарии'
    ],
    'errors' => [
        'not_found' => 'Транзакция не найдена.',
        'list_not_found' => 'Транзакции не найдены.',
        'is_already_verified' => 'Транзакция уже подтверждалась ранее.',
        'is_already_verified_where_retry_sms' => 'Невозможно повторить отправку смс, так как транзакция уже была подтверждена ранее.',
        'is_already_exist' => 'Транзакция уже была добавлена ранее.',
        'queue_send_error' => 'Ошибка отправки транзакции в очередь',
        'status_transaction_status_not_found' => 'Ошибка, указанный статус транзакции не найден',
        'status_transaction_status_detail_not_found' => 'Ошибка, указанный детализированный статус транзакции не найден',
        'status_transaction_is_not_completed' => 'Ошибка, невозможно сделать возврат не завершённой транзакции',
        'status_transaction_is_allready_completed' => 'Ошибка, статус транзакции уже завершен',
        'status_transaction_completed_cannot_be_rejected' => 'Ошибка, транзакцию со статусом "Завершен", нельзя отклонить',
    ],
    'messages' =>[
        'accepted' => 'Транзакция принята на обработку.',
        'warning_chain' => 'Предупреждение в цепочке изменений статуса транзакции из очереди',
    ]
];