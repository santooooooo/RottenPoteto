<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Eloquent\GoodPoint;
use Faker\Generator as Faker;

$factory->define(GoodPoint::class, function (Faker $faker) {
    return [
       'google_user_id' => $faker->numberBetween($min = 1, $max = 10),
       'user_review_id' => $faker->numberBetween($min = 1, $max = 10),
    ];
});
