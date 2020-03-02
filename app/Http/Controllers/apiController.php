<?php

namespace App\Http\Controllers;
use App\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Apartment;
use App\Service;
use App\Message;
use Braintree;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class apiController extends Controller
{
    public function getStatistics(Request $request)
    {
      $data = $request -> validate(['param' => 'numeric']);
        $views = DB::table('views')
        -> select(DB::raw('COUNT(creation_date) AS num'), DB::raw("DATE_FORMAT(creation_date, '%Y-%m-%d') AS giorno_visualizzazione"))
        -> where('apartment_id', $data['param'])
        -> groupBy('giorno_visualizzazione')->get();

        $messages = DB::table('messages')
            ->select(DB::raw('COUNT(creation_date) AS num'), DB::raw("DATE_FORMAT(creation_date, '%Y-%m-%d') AS giorno_visualizzazione"))
            ->where('apartment_id', $data['param'])
            ->groupBy('giorno_visualizzazione')->get();

        $newViews = [];
        foreach($views->toArray() as $view){

            $newViews['dates'][] = $view-> giorno_visualizzazione;
            $newViews['numbers'][] = $view-> num;

        }

        $newMessages = [];
        foreach ($messages->toArray() as $message) {

            $newMessages['dates'][] = $message-> giorno_visualizzazione;
            $newMessages['numbers'][] = $message-> num;

        }

        $results = [

            'views' => $newViews,
            'messages' => $newMessages
        ];

        return response()->json($results);
    }

    public function getBraintreeToken(Request $request){

      $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchant_id'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
    ]);

    $clientToken = $gateway -> clientToken() -> generate();

    return response() -> json($clientToken);

    }




   public function apartmentFilter(Request $request){

    $services = Service::all();
    $radius = $request->get('radius');
    $lat = $request->get('address_lat');
    $lon = $request->get('address_lon');
    $rooms_number = $request->get('rooms_number');
    $guests_number = $request->get('guests_number');
    $servicesQuery = $request->validate(["services" => 'nullable|array']);

    $toFilterApartments = Apartment::select('apartments.*')

    ->selectRaw('( 6371 * acos( cos( radians(?) ) *
                         cos( radians( address_lat) )
                         * cos( radians( address_lon ) - radians(?)
                         ) + sin( radians(?) ) *
                         sin( radians( address_lat ) ) )
                       ) AS distance', [$lat, $lon, $lat])
    ->havingRaw("distance < ?", [$radius])
    ->orderBy('distance', 'ASC')->get();

  $apartments = [];
  foreach ($toFilterApartments as $toFilterApartment) {
    if (($toFilterApartment->rooms_number >= $rooms_number) && ($toFilterApartment->guests_number >= $guests_number) && ($toFilterApartment->visibility == 1)) {
      foreach ($toFilterApartment->sponsorships as $sponsorship) {
        $sponsorships[] = $sponsorship-> id;
      }
      if (!$servicesQuery == 0) {
        $servicesQuery = $request->get('services');

        $serviceFilter = [];
        foreach ($toFilterApartment->services as $x) {
          $serviceFilter[] = $x->id;
        }
        if (count(array_intersect($servicesQuery, $serviceFilter)) == count($servicesQuery)) {
          $apartments[] = $toFilterApartment;
        }
      } else {
        $apartments[] = $toFilterApartment;
      }
    }
  }
  return response() -> json(compact('apartments', 'services'));
}

// public function setMessageStatus(Request $request){
//
//   $apartment = Apartment::findOrFail
// }
}



// public function apartmentFilter(Request $request){
//
//
//   $price = $request->input('price');
//   $rooms_number = $request->input('rooms_number');
//   $guests_number = $request->input('guests_number');
//   $bathrooms = $request->input('bathrooms');
//
//   $wifi = $request->input('wifi');
//   $piscina = $request->input('piscina');
//   $vistaMare = $request->input('vistaMare');
//   $postoAuto = $request->input('postoAuto');
//   $portineria = $request->input('portineria');
//   $sauna = $request->input('sauna');
//   $count=0;
//   if(isset($wifi))
//     $count+=1;
//   if($piscina)
//     $count+=1;
//   if($vistaMare)
//     $count+=1;
//   if($postoAuto)
//     $count+=1;
//   if($portineria)
//     $count+=1;
//   if($sauna)
//     $count+=1;
//
//   $latitude = -56.424501;
//   $longitude = 115.888947;
//   $data = $request -> all();
//   $radius = 7000;
//   $apartments = Apartment::selectRaw('apartment_service.apartment_id, apartments.title, apartments.description, price, rooms_number, guests_number, bathrooms,  apartments.address_lat, apartments.address_lon,( 6371 * acos( cos( radians(?) ) * cos( radians( address_lat ) )* cos( radians( address_lon ) - radians(?)) + sin( radians(?) ) * sin( radians( address_lat ) ) )) AS distance', [$latitude, $longitude, $latitude])
//
//     ->join('apartment_service' , 'apartments.id' , '=' , 'apartment_service.apartment_id')
//     ->when($price, function ($query, $price){
//         return $query->where('price', '<', $price);
//     })
//     ->when($rooms_number, function ($query, $rooms_number){
//         return $query->where('rooms_number', '=', $rooms_number);
//     })
//     ->when($guests_number, function ($query, $guests_number){
//         return $query->where('guests_number', '=', $guests_number);
//     })
//     ->when($bathrooms, function ($query, $bathrooms){
//         return $query->where('bathrooms', '=', $request->input('bathrooms'));
//     })
//     ->when($wifi || $piscina || $vistaMare || $postoAuto || $portineria || $sauna, function ($query) use ($request){
//         return $query->whereIn('service_id', [$request->input('wifi') ?? NULL,
//                                               $request->input('piscina') ?? NULL,
//                                               $request->input('vistaMare') ?? NULL,
//                                               $request->input('postoAuto') ?? NULL,
//                                               $request->input('portineria') ?? NULL,
//                                               $request->input('sauna') ?? NULL
//                                             ]);
//     })-> groupBy('apartment_id')
//       -> when($wifi || $piscina || $vistaMare || $postoAuto || $portineria || $sauna, function($query) use ($count){
//         return  $query -> havingRaw('COUNT(*) = ?' [$count]);
//       })
//       -> havingRaw('distance < ?', [$radius])
//       -> get();
//
//   foreach ($apartments as $apartment){
//     $services = Apartment::findOrFail($apartment -> apartment_id) -> services;
//     $apartment['services'] = $services;
//   }
//
//   return response()-> json($apartments);
//
// }

//SELECT apartment_id, COUNT(created_at) AS n_view, DATE_FORMAT(created_at, '%Y-%m-%d') as giorno_visualizzazione
//FROM views WHERE apartment_id=36 GROUP BY giorno_visualizzazione
//ORDER BY COUNT(created_at) DESC;


// SELECT apartment_service.apartment_id, apartments.title, apartments.description, services.name
// from apartments
// join apartment_service
// on apartments.id=apartment_service.apartment_id
// join services
// on services.id=apartment_service.service_id
// WHERE service_id IN (1,2)
// group BY apartment_id
// ORDER BY `apartment_service`.`apartment_id` ASC
