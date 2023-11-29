<?php

use Faker\Generator as Faker;

$factory->define(App\Tester::class, function (Faker $faker) {

    $fields = [];

    $accounts = [
        'account',
        'number',
        'phone',
        'receiver',
        'sender',
    ];

    for ($i = 0; $i <= 5; $i++) {
        $field = new stdClass();
        $field->input_number = $faker->numberBetween(100000, 99999999);
        $field->input_name = $accounts[rand(0, 4)];

        $fields[] = $field;
    }

    $tester = \App\UserTest::skip(rand(0,499999))->limit(1)->get();
    $tester2 = \App\UserTest::skip(rand(0,499999))->limit(1)->get();

    return [
        'id' => $faker->uuid,
        'name' => $faker->name,
        'from_id' => $tester[0]->id,
        'to_id' => $tester2[0]->id,
        'amount' => $faker->randomFloat(2, 1, 1000),
        'count' => $faker->numberBetween(0, 100000),
        'uuid_index_simple' => $faker->uuid,
        'uuid_index_full_text' => $faker->uuid,
        'meta' => json_encode($fields),
        'session_number' => $faker->numberBetween(100000),
        'created_at' => $faker->dateTimeBetween('-1 years'),
        'updated_at' => $faker->dateTimeBetween('-1 years'),
    ];
});
