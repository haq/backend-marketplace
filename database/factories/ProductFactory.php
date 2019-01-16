<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'price' => $faker->randomNumber(6),
        'inventory_count' => $faker->randomDigitNotNull,
        'updated_at' => Carbon::now(),
        'created_at' => Carbon::now()
    ];
});
