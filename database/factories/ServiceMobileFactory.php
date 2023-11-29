<?php

use App\Models\Service;
use Faker\Generator as Faker;

$factory->define(Service::class, function (Faker $faker) {
    return [
        'id' => 'eb9ea323-cb88-11e8-993a-b06ebfbfa715',
        'code' => 'MOBILE_TCELL_TJ_123',
        'processing_code' => '123123',
        'name' => 'Tcell123',
        'icon_url' => 'tcell.png',
        'min_amount' => '1',
        'max_amount' => '5000',
        'is_active' => '1',
        'requestable_balance_params' => null,
        'is_to_accountable' => '0',
        'position' => 10000,
        'gateway_id' => config('app_settings.default_gateway_id'),
        'currency_id' => config('app_settings.default_currency_id'),
        'params_json' => [
            [
                "input_placeholder" => "Номер телефона",
                "input_name" => "phone_number",
                "input_type" => "number",
                "keyboard_type" => "phone",
                "icon_url" => "tcell.png",
                "regexp" => "(92|93|50|77){1}\\d{7}",
                "chars_mask" => "__ ___ __ __",
                "min_length" => 9,
                "max_length" => 9,
            ],
        ],
    ];
});
