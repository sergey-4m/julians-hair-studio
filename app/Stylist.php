<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stylist extends Model
{
    protected $fillable = [
		'first_name', 'last_name', 'email', 'phone', 'mobile'
	];

	/*public function services()
	{
		return $this->belongsToMany('App\Service');
	}*/
}
