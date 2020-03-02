<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ApartmentCreateRequest;
use App\Http\Requests\ApartmentEditRequest;
use App\Http\Requests\MessageRequest;
use App\User;
use App\Apartment;
use App\Service;
use App\View;
use App\Sponsorship;
use App\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Braintree;

class ApartmentController extends Controller
{

  public function __construct(){

    $this -> middleware('auth') -> except(['show', 'search']);
  }
    public function create(){
      $services = Service::all();
      return view('pages.apartment-register', compact('services'));
    }

    public function store(ApartmentCreateRequest $request){

      $data = $request->all();

      $validatedData = $request -> validated();

      $user = User::findOrFail(Auth::id());

      $file = $request -> file('image') -> store('apartments', 'public');

      $validatedData['image'] = $file;

      $new_apartment = Apartment::make($validatedData);

      $new_apartment -> user() -> associate($user) -> save();

      if (isset($data['services'])) {
        $dataServices = $data['services'];
        $services = Service::find($dataServices);
        $new_apartment->services()->attach($services);
      }

      return redirect() -> route('user-apartments', $user -> id) -> with('success_message_register', 'Appartamento inserito con successo!');
    }


public function userApartments($id){
  if( Auth::id() == $id ){
    $user = User::findOrFail($id);
    $apartments = $user -> apartments;
    return view('pages.user-apartments', compact('apartments'));
  } else{
    abort(404);
  }
}

    public function show($id){

      $apartment = Apartment::findOrFail($id);
      if($apartment -> visibility == 0 && (Auth::id() !== $apartment -> user -> id)){
        abort(404);
      }
      // $viewed = session() -> get('apartments', []);
      $aptkey = 'apt_' . $id;
      if(!Session::has($aptkey)){
        if(Auth::id() !== $apartment -> user -> id || !Auth::check()){
          $date = Carbon::now();
          $view = View::make();
          $view -> creation_date = $date;
          $view -> apartment() -> associate($apartment) -> save();
          Session::put($aptkey, 1);
        }
      }
      return view('pages.show-apartment', compact('apartment'));
    }

    public function edit($id) {
      $apartment = Apartment::findOrFail($id);
      if(Auth::id() !== $apartment -> user -> id)
        abort(404);
      $services = Service::all();
      return view('pages.edit-apartment', compact('apartment', 'services'));
    }

    public function update(ApartmentEditRequest $request, $id) {
      $data = $request->all();
      $validatedData = $request -> validated();
      if (isset($data['image'])) {
      $file = $request -> file('image') -> store('apartments', 'public');
      $validatedData['image'] = $file;
      }
      $apartment = Apartment::findOrFail($id);
      $apartment->update($validatedData);
      if (isset($data['services'])) {
        $dataServices = $data['services'];
        $services = Service::find($dataServices);
        $apartment->services()->sync($services);
      }
      return redirect()->route('show-apartment', $apartment -> id) -> with('success_message_update', 'Appartamento modificato con successo!');
    }

    public function delete($id) {
      $user = User::findOrFail(Auth::id());
      $apartment = Apartment::findOrFail($id);
      $apartment->services()->detach();
      $apartment->sponsorships()->detach();
      $apartment->views()->delete();
      $apartment->messages()->delete();
      $apartment->delete();
      return redirect()->route('user-apartments', $user->id) -> with('apartment_deleted', 'Appartamento cancellato con successo!');
    }

    public function buySponsorship($id){

      $apartment = Apartment::findOrFail($id);

      if(DB::table('apartment_sponsorship') -> where([['apartment_id', $apartment -> id], ['expired', 0]]) -> exists()){
        return redirect() -> back() -> with('already_exist', 'A sponsorship for this apartment already exists!');
      }

      return view('pages.buy-sponsorship', compact('apartment'));
    }

    public function checkoutSponsorship(Request $request, $id){

      $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchant_id'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
    ]);


    $sponsorship = Sponsorship::findOrFail($request -> sponsorship);
    $amount = $sponsorship -> price;
    $nonce = $request -> payment_method_nonce;

    $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'customer' => [
                'firstName' => Auth::user() -> name,
                'lastName' => Auth::user() -> surname,
                'email' => Auth::user() -> email,
            ],
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result -> success) {
            $transaction = $result -> transaction;
            $apartment = Apartment::findOrFail($id);
            $date = Carbon::now();
            $apartment -> sponsorships() -> attach($sponsorship, ['creation_date' => $date, 'expired' => false]);
            return redirect() -> route('show-apartment', $apartment -> id ) -> with('success_message', 'Transaction successful. The ID is: '. $transaction -> id);
        } else {
            $errorString = "";

            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            // $_SESSION["errors"] = $errorString;
            // header("Location: index.php");
            return back()->withErrors('An error occurred with the message: '.$result->message);
        }
    }

        public function statistics($id){

          $apartment = Apartment::findOrFail($id);
          if(Auth::id() == $apartment -> user -> id)
            return view('pages.statistics', compact('id'));
          else
            abort(404);

          return view('pages.statistics', compact('id'));
        }



       public function search()
        {
          $apartments = Apartment::all();
          $services = Service::all();
          return view('pages.search', compact('apartments'));
        }

}
