<?php

namespace App;

use App\Traits\Slugger;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use Slugger;
    
    public function apartment()
    {
        return $this->belongsToMany('App\Apartment');
    }
}
