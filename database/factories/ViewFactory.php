<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\View;
use Faker\Generator as Faker;

$factory->define(View::class, function (Faker $faker) {
    return [
        'creation_date' => $faker -> dateTimeThisMonth($max = 'now') 
    ];
});
