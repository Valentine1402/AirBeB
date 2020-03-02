<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Apartment;
use Faker\Generator as Faker;


$factory->define(Apartment::class, function (Faker $faker) {


  $names = [
    'Appartamento al mare',
    'Appartamento in montagna',
    'Appartamento al lago',
    'Appartamento in città',
    'Villa sulla spiaggia',
    'Casa di campagna',
    'Baita sulla neve',
    'Trilocale con vista mare',
    'Monolocale nella foresta'
  ];
  $images = [
    'appartamento-1',
    'appartamento-2',
    'appartamento-3',
    'appartamento-4',
    'appartamento-5',
    'appartamento-6',
    'appartamento-7',
    'appartamento-8',
    'appartamento-9',
    'appartamento-10'
  ];

  return [
      'title' => $names[rand(0, 8)],
      'description' => $faker -> text($maxNbChars = 500),
      'price' => rand(500 , 100000) / 100,
      'rooms_number' => rand(1, 8),
      'guests_number'=> rand(1,8),
      'bathrooms' => rand(1,4),
      'area_sm'=> rand(15,500),
      'address_lat' => $faker ->latitude($min = 36, $max = 45) ,
      'address_lon'=> $faker ->longitude($min = 8, $max = 18),
      'address' => $faker -> address(),
      'visibility' => 1,
      'image'=> 'apartments/' .$images[rand(0, 9)] .'.jpg'
  ];
});
