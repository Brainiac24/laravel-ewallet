<?php

use App\Models\User\User;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
 */

$factory->define(User::class, function (Faker $faker) {
    $var = $faker->creditCardNumber;
    return [
        'id' => '6bac2221-af38-11e8-904b-b06ebfbfa715',
        'photo' => 'image.jpg',
        'username' => '992927777777',
        'msisdn' => '992927777777',
        'first_name' => 'TestName',
        'last_name' => 'TestLastName',
        'middle_name' => 'TestMiddleName',
        'email' => 'test@gmail.com',
        'password' => bcrypt('test'),
        'attestation_id' => config('app_settings.default_attestation_id'),
        'is_active' => '1',
        "contacts_json" => [
            "date_birth" => "1992-06-24",
            "gender" => 1,
        ],
        "user_settings_json" => [
            [
                "code" => "sms",
                "is_active" => "1",
            ],
        ],
        'devices_json' =>
        [
            "id" => "41DC2FA0-9688-4DBF-AFF0-494774476B4112",
            "name" => "iPhone",
            "model" => "iPhone",
            "type" => "iPhone",
            "appVersion" => "1.0.1",
            "appMenuVersion" => "1.0",
            "os" => "10.3.3",
            "platform" => "0",
        ],

        'limits_json' => [
            "day" =>
            [
                "limit" => 0,
                "updated_at" => "2018-07-31 17:41:57",
            ],
            "week" =>
            [
                "limit" => 0,
                "updated_at" => "2018-07-31 17:41:57",
            ],
            "month" =>
            [
                "limit" => 0,
                "updated_at" => "2018-07-31 17:41:57",
            ],
        ],
    ];
});
