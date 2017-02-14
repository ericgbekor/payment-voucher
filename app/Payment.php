<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    
/**
* The table associated with the model.
*
* @var string
*/
protected $table = 'payment-vouchers';


protected $fillable = ['status','amount','withholding','vat','description','rate','cheque','attachments'];
}
