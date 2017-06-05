<?php

namespace App\Http\Controllers;

/**
 *  @author: Eric Korku Gbekor
 *  description: This controller communicates with the relevant models to perform excel imports and exports
 */
use Illuminate\Http\Request;
//use Request;
use App\Payment;
use App\Summary;
use Excel;
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
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Export values of specified resources in storage to csv format.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return void
     */
    public function exportExcel(Request $request) {

        $pv = array();
        $pv[] = [['id' => 'id', 'currency' => 'currency', 'amount' => 'amount', 'netpayable' => 'netpayable', 'withholding' => 'withholding', 'vat' => 'vat', 'description' => 'description', 'rate' => 'rate', 'payee' => 'payee', 'cheque' => 'cheque', 'status' => 'status', 'debit' => 'debit', 'credit' => 'credit', 'department' => 'department', 'created_at' => 'created_at', 'updated_at' => 'updated_at']];

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

     /**
     * Export values of specified resources in storage to csv format.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return void
     */
    public function cheque(Request $request) {

        $pv = array();
        $pv[] = [['name' => 'Name', 'amount' => 'Amount']];

        if ($request->has('id')) {
            foreach ($request->id as $id) {
                
                $pv[] = Summary::where('id', $id)->select('payee', 'netpayable')
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

     /**
     * Calculate net payable from total amount, withholding tax and VAT.
     *
     * @param  $value double
     * 
     * @return $net double
     */
    public function getNetPayable($value) {
        if ($value->has('amount')) {
            $amount = $value->amount;
            $vat = $value->vat;
            $wth = $value->withholding;

            $net = $amount - ($vat + $wth);
            return $net;
        }
    }

     /**
     * Import values of xls file into storage for specified resources .
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return redirect
     */
    public function importExcel(Request $request) {

        $path = $request->file('import_file')->path();
        $values = Excel::load($path, function($reader) {
                    
                })->get();
        if (!empty($values) && $values->count()) {
            foreach ($values as $key => $value) {
                $pv = new Payment();

                if ($request->hasFile('import_file')) {
                    $pv->amount = $value->amount;
                    $pv->description = $value->description;
                    $pv->rate = $value->rate;
                    $pv->cheque = $value->cheque;
                    $pv->accountDebited = $value->debit;
                    $pv->accountCredited = $value->credit;
                    $pv->netpayable = $this->getNetPayable($value);
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
