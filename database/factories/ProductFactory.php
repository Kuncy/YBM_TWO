<?php

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name'=> $faker->numberBetween(100000,999999),
        'count' => $faker->numberBetween(1, 3),
        'maxcount' => $faker->numberBetween(3, 4),
        //
    ];
});
