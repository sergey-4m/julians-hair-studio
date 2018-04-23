<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
    	'date_at', 'brand', 'bleach', 'tint', 'peroxide_volume', 'perm', 'charge'
    ];

    public function service()
    {
        return $this->hasMany('App\ServiceItem');
    }

    public function client()
    {
    	return $this->hasMany('App\Client');
    }

    public function stylist()
    {
    	return $this->hasMany('App\Stylist');
    }
}
