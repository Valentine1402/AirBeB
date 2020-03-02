<?php

use Carbon\Carbon;
use App\Sponsorship;
use App\Apartment;

Route::get('/', function () {

  $new_apartments = [];
  $apartments = Apartment::all();
  foreach ($apartments as $apartment) {
    foreach ($apartment -> sponsorships as $sponsorship) {
      if($sponsorship -> pivot -> expired == false){
        $new_apartments[] = $apartment;
      }
    }
  }
    return view('pages.homePage', compact('new_apartments'));
})->name('home') -> middleware('sponsorship');

Auth::routes();

Route::get('/register-apartment', 'ApartmentController@create') -> name('apartment-register');

Route::post('/store-apartment', 'ApartmentController@store') -> name('apartment-store');

Route::get('/users/{id}/apartments', 'ApartmentController@userApartments') -> name('user-apartments');

Route::get('apartment/{id}', 'ApartmentController@show') -> name('show-apartment');

Route::get('apartment/{id}/edit', 'ApartmentController@edit') -> name('edit-apartment');

Route::post('apartment/{id}/edit', 'ApartmentController@update') -> name('update-apartment');

Route::get('apartment/{id}/delete', 'ApartmentController@delete') -> name('delete-apartment');

Route::get('apartment/{id}/buy-sponsorship', 'ApartmentController@buySponsorship') -> name('buy-sponsorship');

Route::post('apartment/{id}/checkout-sponsorship', 'ApartmentController@checkoutSponsorship') -> name('checkout');

Route::post('apartment/{id}/store-message', 'MessageController@storeMessage') -> name('store-message');

Route::get('user/{id}/messages', 'MessageController@userMessages') -> name('user-messages');

Route::get('apartment/{id}/messages', 'MessageController@apartmentMessages') -> name('apartment-messages');

Route::get('apartment/{id}/statistics', 'ApartmentController@statistics')->name('statistics');

Route::get('/search', 'ApartmentController@search')->name('search') -> middleware('sponsorship');

Route::post('/user/{id}/avatar', 'UserController@setAvatar') -> name('set-avatar');

Route::get('/user/{id}/info', 'UserController@userInfo') -> name('user-info');
