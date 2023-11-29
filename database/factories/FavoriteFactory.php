<?php


use App\Models\Favorite\Favorite;
use App\Services\Common\Helpers\Service;
use Faker\Generator as Faker;

$factory->define(Favorite::class, function (Faker $faker) {
    return [
        'id' => 'edd07112-af73-11e8-904b-b06ebfbfa715',
        'name' => 'Оплата2',
        'value' => 100,
        'params_json' => [
            [
                "input_name" => "phone_number",
                "input_value" => "992927777777",
            ],
            [
                "input_name" => "card_number",
                "input_value" => "1234567891234567",
            ],
        ],
        'service_id' => Service::MOBILE_TCELL_TJ,
        
    ];
});
