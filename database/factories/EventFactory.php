<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\db\Event;
use Faker\Generator as Faker;

$factory->define(Event::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
        'date' => $faker->dateTime(),
        'city' => $faker->city,
    ];
});
