<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Sponsorship;
use Faker\Generator as Faker;

$factory->define(Sponsorship::class, function (Faker $faker) {

    return [
        'name' => $faker -> text($maxNbChars = 50),
        'price' => rand(500 , 100000) / 100,
        'hours' => rand(1 , 200)
    ];
});
