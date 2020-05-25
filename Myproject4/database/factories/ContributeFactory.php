<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Eloquent\Contribute;
use Faker\Generator as Faker;

$factory->define(Contribute::class, function (Faker $faker) {
	$now = \Carbon\Carbon::now();
    return [
        'id' => 1,
        'title' => $faker->word,
        'contents' => $faker->text($maxNbChars = 200),
        'picture' => $faker->word,
        'genre' => $faker->word,
        'created_at' => $now,
        'updated_at' => $now,
    ];
});
