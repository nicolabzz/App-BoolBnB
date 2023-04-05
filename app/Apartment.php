<?php

namespace App;

use App\Traits\Slugger;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use Slugger;

    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    public function views()
    {
        return $this->hasMany('App\View');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function sponsorship()
    {
        return $this->belongsToMany('App\Sponsorship');
    }

    public function services()
    {
        return $this->belongsToMany('App\Service');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
