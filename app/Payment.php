<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
	use SoftDeletes;
    
/**
* The table associated with the model.
*
* @var string
*/
protected $table = 'vouchers';


protected $fillable = ['status','amount','withholding','vat','description','rate','cheque','attachments'];

public function debit(){

		return $this->belongsTo('App\Account','accountDebited');
	}

public function credit(){

		return $this->belongsTo('App\Account','accountCredited');
	}

public function department(){

		return $this->belongsTo('App\Department','department');
	}

public function create(){

		return $this->belongsTo('App\User','creator');
	}

public function review(){

		return $this->belongsTo('App\User','reviewer');
	}

public function approve(){

		return $this->belongsTo('App\User','approver');
	}

public function payee(){

		return $this->belongsTo('App\Supplier','payee');
	}
}
