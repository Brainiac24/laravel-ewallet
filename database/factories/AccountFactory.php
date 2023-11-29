<?php

use App\Models\Account\Account;
use App\Models\User\User;
use Faker\Generator as Faker;

$factory->define(Account::class, function (Faker $faker) {
    return [
        'id' => '73ca30df-af38-11e8-904b-b06ebfbfa715',
        'number' => '1000000000000001',
        'balance' => 500,
        'blocked_balance' => 0,
        'account_type_id' => config('app_settings.default_wallet_account_type_id'),
        'currency_id' => config('app_settings.default_currency_id'),
    ];
});
