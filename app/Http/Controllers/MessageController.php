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
use Carbon\Carbon;
use Braintree;

class MessageController extends Controller
{
    public function storeMessage (MessageRequest $request, $id) {
        $validatedData = $request -> validated();
        $apartment = Apartment::findOrFail($id);
        $message = Message::make($validatedData);
        $date = Carbon::now();
        $message -> creation_date = $date;
        $message -> read = false;
        $message -> apartment() -> associate($apartment) -> save();
        return redirect() -> route('show-apartment', $apartment->id) -> with('message_sent', 'Messaggio inviato!');
    }

    public function userMessages ($id) {
        if( Auth::id() == $id ){
            $user = User::findOrFail($id);
            $apartments = $user -> apartments;
            $messages = [];
            foreach ($apartments as $apartment) {
                $aptMessages = $apartment -> messages() -> orderBy('created_at', 'desc') -> get();
                foreach ($aptMessages as $aptMessage) {
                    $messages[] = $aptMessage;
                }
            }
            $collection = collect($messages) -> sortByDesc('created_at');
            $messages = $collection -> values() -> all();
            return view('pages.user-messages', compact('messages'));
        } else{
            abort(404);
        }
    }

    public function apartmentMessages ($id) {
        $apartment = Apartment::findOrFail($id);
        $user = $apartment->user;
        if( Auth::id() == $user->id ){
            $messages = $apartment -> messages() -> orderBy('created_at', 'desc') -> get();
            return view('pages.apartment-messages', compact('messages'));
        } else{
            abort(404);
        }
    }

    public function setMessageRead(){

    }

    public function setMessageToRead(){

    }
}
