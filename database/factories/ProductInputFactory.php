<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductInput;
use Faker\Generator as Faker;

$factory->define(ProductInput::class, function (Faker $faker) {
    return [
        'amount' => $faker->numberBetween(3, 25)
    ];
});
