<?php

use App\Models\Transaction\Transaction;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    return [
        'id' => 'd96f03e7-d609-11e8-9eb4-b06ebfbfa715',
        'from_account_id' => '1000000000000001',
        'service_id' => '14f8e166-9fb5-11e8-904b-b06ebfbfa715',
        'amount' => 5,
        'commission' => 0.2,
        'params_json' => [
            [
                "key" => "phone_number",
                "value" => "992928553004",
                "name" => "Номер получателя",
            ],
            [
                "key" => "comment",
                "value" => "ЦУ 123 qwe йцу",
                "name" => "Комментарий",
            ],
        ],
        'session_number' => 999999999,
        'transaction_type_id' => 0,
        'transaction_status_id' => 0,
        'transaction_status_detail_id' => 0,
        'add_to_favorite' => 0,
        'is_queued' => 0,
        'session_in' => 0,
    ];
});
