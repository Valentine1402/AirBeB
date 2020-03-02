<?php

use Illuminate\Database\Seeder;
use App\Apartment;
use App\User;
use App\Service;
use App\Sponsorship;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Apartment::class, 50)
                -> make()
                -> each(function($apartment){

                $user = User::inRandomOrder() -> first();
                $apartment -> user() -> associate($user); // 1 x M
                $apartment -> save(); //sempre prima dell'attach

                $service = Service::inRandomOrder()
                -> take(rand(0,4)) -> get();
                $apartment -> services() -> attach($service); // N x M (con create o make + save)

                // $sponsorship = Sponsorship::inRandomOrder()
                // -> take(rand(0,4)) -> get();
                // $apartment -> sponsorships() -> attach($sponsorship); // N x M (con create o make + save)
                // });

    });
  }
}
