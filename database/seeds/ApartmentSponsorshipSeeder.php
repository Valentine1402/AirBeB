<?php

use Illuminate\Database\Seeder;

use App\Apartment;
use App\Sponsorship;
use Carbon\Carbon;

class ApartmentSponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for($i=0; $i<6;$i++){
        $apartament = Apartment::inRandomOrder() -> first();
        $sponsorship = Sponsorship::find(3);
        $apartament -> sponsorships() -> attach($sponsorship, ['creation_date' => Carbon::now(), 'expired' => 0]);
      }
    }
}
