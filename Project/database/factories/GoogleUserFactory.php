<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Eloquent\GoogleUser;
use Faker\Generator as Faker;

$factory->define(GoogleUser::class, function (Faker $faker) {
 	 $now = \Carbon\Carbon::now();
    return [
        'gmail' => $faker->email,
        'name' => $faker->name($gender = null),
				'safety' => true,
        'created_at' => $now,
        'updated_at' => $now,
    ];
});
