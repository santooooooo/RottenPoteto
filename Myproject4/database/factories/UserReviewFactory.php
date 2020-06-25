<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Eloquent\UserReview;
use Faker\Generator as Faker;

$factory->define(UserReview::class, function (Faker $faker) {
	$now = \Carbon\Carbon::now();
    return [
       'contribute_id' => $faker->numberBetween($min = 1, $max = 10),
       'google_user_id' => $faker->numberBetween($min = 1, $max = 10), 
       'title' => $faker->word,
       'review' => $faker->text($maxNbChars = 1000), 
       'spoiler' => 0,
       'satisfaction' => $faker->numberBetween($min = 0, $max = 5), 
       'recommended' => $faker->numberBetween($min = 0, $max = 5), 
       'good_point' => $faker->numberBetween($min = 1, $max = 10),
       'created_at' => $now,
       'updated_at' => $now,
    ];
});
