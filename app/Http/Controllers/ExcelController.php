<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Request;
use App\Payment;
use App\Summary;
use Excel;
use PDF;
use Response;
use App\Payee;
use DB;
use Auth;

class ExcelController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
{
    $this->middleware('auth');
}
    
    public function exportExcel(Request $request) {
        
        $pv = array();
        $pv[] = [['id' => 'id', 'currency' => 'currency', 'amount' => 'amount', 'netpayable'=>'netpayable' , 'withholding' => 'withholding', 'vat' => 'vat', 'description' => 'description', 'rate' => 'rate', 'payee' => 'payee', 'cheque' => 'cheque','status' => 'status','debit' => 'debit', 'credit' => 'credit','department'=>'department', 'created_at' => 'created_at', 'updated_at' => 'updated_at']];

        if ($request->has('id')) {
            foreach ($request->id as $id) {
                
                $pv[] = Summary::where('id', $id)->get();
            }
          Excel::create('Payments', function($data) use ($pv) {
                $data->sheet('Vouchers', function($values) use ($pv) {
                    foreach ($pv as $row) {
                        $values->fromModel($row, null, 'A1', false, false);
                    }
                });
            })->export('csv');
        }
    }
    
    public function cheque(Request $request) {
        
        $pv = array();
        $pv[] = [['name' => 'Name', 'amount' => 'Amount']];

        if ($request->has('id')) {
            foreach ($request->id as $id) {
               // $id = $request->id;
                $pv[] = Summary::where('id',$id)->select('payee','netpayable')
                   ->get();
            }
          Excel::create('Vouchers', function($data) use ($pv) {
                $data->sheet('Vouchers', function($values) use ($pv) {
                    foreach ($pv as $row) {
                        $values->fromModel($row, null, 'A1', false, false);
                    }
                });
            })->export('csv');
        }
    }


    public function getNetPayable($value) {
        if ($value->has('amount')) {
           $amount=$value->amount;
           $vat = $value->vat;
           $wth = $value->withholding;
           
           $net = $amount-($vat+$wth);
           return $net;
    }

    }

    public function importExcel(Request $request) {

        $path = $request->file('import_file')->path();
        $data = Excel::load($path, function($reader) {
                    
                })->get();
        if (!empty($data) && $data->count()) {
            foreach ($data as $key => $value) {
                $pv = new Payment();

                if ($request->hasFile('import_file')) {
                    $pv->amount = $value->amount;
                    $pv->description = $value->description;
                    $pv->rate = $value->rate;
                    $pv->cheque = $value->cheque;
                    $pv->accountDebited = $value->debit;
                    $pv->accountCredited = $value->credit;
                    $pv->netpayable=$this->getNetPayable($value);
                    // $pv->accountCredited = $value->accountcredited;
                    $pv->payee = $value->payee;
                    $pv->currency = $value->currency;
                    $pv->status = "created";
                    $pv->vat = $value->vat;
                    $pv->withholding = $value->withholding;
                    $pv->creator = Auth::user()->id;
                    $pv->save();
                } else {
                    echo "Error";
                }
            }
            return redirect('viewtransactions');
        }
    }

}
