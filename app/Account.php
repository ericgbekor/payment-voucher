<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
	use SoftDeletes;

	public function payment(){

		return $this->hasMany('App\Payment','accountDebited');
		}


	public function payments(){

		return $this->hasMany('App\Payment','accountCredited');
		}
    //
}
