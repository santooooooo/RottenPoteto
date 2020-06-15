<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Eloquent\UserReview;
use Faker\Generator as Faker;

$factory->define(UserReview::class, function (Faker $faker) {
	$now = \Carbon\Carbon::now();
    return [
       'contribute_id' => 1, 
       'google_user_id' => 1, 
       'title' => $faker->word,
       'review' => $faker->text($maxNbChars = 1000), 
       'satisfaction' => $faker->numberBetween($min = 0, $max = 5), 
       'recommended' => $faker->numberBetween($min = 0, $max = 5), 
        'created_at' => $now,
        'updated_at' => $now,
    ];
});
