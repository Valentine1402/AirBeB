<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable =[
        'mail',
        'content',
        'creation_date'
    ];

    public function apartment(){
        return $this -> belongsTo(Apartment::class);
    }
}
