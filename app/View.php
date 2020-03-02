<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
  protected $fillable = ['creation_date'];

    public function apartment(){
        return $this -> belongsTo(Apartment::class);
    }
}
