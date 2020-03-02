<?php

use Illuminate\Database\Seeder;
use App\Service;
use App\Apartment;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            ['name' => 'WiFi'],
            ['name' => 'Piscina'],
            ['name' => 'Vista mare'],
            ['name' => 'Posto auto'],
            ['name' => 'Portineria'],
            ['name' => 'Sauna']
        ];

        for ($i=0; $i<count($services) ; $i++) { 
            $service = new Service;
            $service->fill($services[$i]);
            $service->save();
            $apartments = Apartment::inRandomOrder()->take(rand(0,4))->get();
            $service->apartments()->attach($apartments);
        }
        // factory(Service::class ,50)
        //         ->create()
        //         ->each(function($service){
        //             $apartments = Apartment::inRandomOrder() -> take(rand(0,4)) -> get();
        //             $service -> apartments()  -> attach($apartments);
        //         });
    }
}
