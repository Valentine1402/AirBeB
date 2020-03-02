<?php

use Illuminate\Database\Seeder;
use App\View;
use App\Apartment;

class viewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(View::class, 1000)
         -> make()
         -> each( function($view) {
            $apartment = Apartment::inRandomOrder()->first();
            $view ->apartment()->associate($apartment);
            $view ->save();
         });
    }
}
