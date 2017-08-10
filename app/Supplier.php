<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
	use SoftDeletes;
    //

    public function suppliers(){

		return $this->hasMany('App\Payment','payee');
	}
}
