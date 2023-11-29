<?php

use Faker\Generator as Faker;

$factory->define(App\UserTest::class, function (Faker $faker) {
    return [
        'id' => $faker->uuid,
        'name' => $faker->name,
        'created_at' => $faker->dateTimeBetween('-1 years'),
        'updated_at' => $faker->dateTimeBetween('-1 years'),
    ];
});
