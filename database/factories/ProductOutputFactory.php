<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductOutput;
use Faker\Generator as Faker;

$factory->define(ProductOutput::class, function (Faker $faker) {
    return [
        'amount' => $faker->numberBetween(1, 2)
    ];
});
