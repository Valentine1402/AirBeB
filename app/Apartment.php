<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price',
        'rooms_number',
        'guests_number',
        'bathrooms',
        'area_sm',
        'address_lat',
        'address_lon',
        'address',
        'visibility',
        'image'
    ];

    public function user(){
        return $this -> belongsTo(User::class);
    }

    public function messages(){
        return $this -> hasMany(Message::class);
    }

     public function views(){
        return $this -> hasMany(View::class);
    }

    public function services(){
        return $this -> belongsToMany(Service::class);
    }

    public function sponsorships(){

        return $this -> belongsToMany(Sponsorship::class)->withPivot('creation_date', 'expired');


    }

}
