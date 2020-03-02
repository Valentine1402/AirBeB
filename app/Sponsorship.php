<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    protected $fillable = [
        'name',
        'price',
        'hours'
    ];

    public function apartments(){
        return $this -> belongsToMany(Apartment::class)->withPivot('creation_date', 'expired');
    }
}
