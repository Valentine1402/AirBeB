<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    return [
        'mail' => $faker -> email(),
        'content' => $faker -> text($maxNbChars = 200),
        'creation_date' => $faker -> dateTimeThisMonth($max = 'now'),
        'read' => false
    ];
});
