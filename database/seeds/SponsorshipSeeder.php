<?php

use Illuminate\Database\Seeder;
use App\Sponsorship;
use App\Apartment;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // public function run()
    // {
    //     factory(Sponsorship::class ,50)
    //             ->create()
    //             ->each(function($sponsorship){
    //                 $apartments = Apartment::inRandomOrder() -> take(rand(0,4)) -> get();
    //                 $sponsorship -> apartments() -> attach($apartments);
    //             });
    // }

    public function run()
    {
      $sponsorships = [

        [

          'name' => '2,99€ per 24 ore di sponsorizzazione',
          'price' => 2.99,
          'hours' => 24

        ],
        [

          'name' => '5.99€ per 72 ore di sponsorizzazione',
          'price' => 5.99,
          'hours' => 72

        ],
        [

          'name' => '9,99€ per 144 ore di sponsorizzazione',
          'price' => 9.99,
          'hours' => 144

        ]


      ];

      foreach ($sponsorships as $sponsorship) {
        $new_sponsorship = Sponsorship::create($sponsorship);
        // $apartments = Apartment::inRandomOrder() -> take(rand(0,4)) -> get();
        // $new_sponsorship -> apartments() -> attach($apartments);
      }

    }
}
