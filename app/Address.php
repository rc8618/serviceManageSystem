<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';

    protected $fillable = [
        'name', 'user_id', 'email', 'street', 'mobile_no','country_id','services'
    ];

    public function addressCountry()
    {
        return $this->belongsTo('App\Country','country_id');

    }
}
