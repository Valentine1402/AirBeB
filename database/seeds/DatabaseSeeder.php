<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            SponsorshipSeeder::class,
            ServiceSeeder::class,
            ApartmentSeeder::class,
            MessageSeeder::class,
            viewSeeder::class,
            ApartmentSponsorshipSeeder::class
            ]);
    }
}
