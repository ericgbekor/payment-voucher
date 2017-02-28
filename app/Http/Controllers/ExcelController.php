<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use Excel;
use PDF;

class ExcelController extends Controller {

    //

    public function exportExcel(Request $request) {
        $pv = array();
        $pv[] = [['id' => 'id', 'status' => 'status', 'currency' => 'currency', 'amount' => 'amount', 'WHT' => 'WHT', 'withholding' => 'withholding', 'nhil' => 'nhil', 'vat' => 'vat', 'description' => 'description', 'rate' => 'rate', 'payee' => 'payee', 'recipient-name' => 'recipient-name', 'cheque' => 'cheque',
        'accountDebited' => 'accountDebited', 'accountCredited' => 'accountCredited', 'creator' => 'creator', 'reviewer' => 'reviewer', 'approver' => 'approver', 'attachments' => 'attachments', 'created_at' => 'created_at', 'updated_at' => 'updated_at']];

        if ($request->has('id')) {
            foreach ($request->id as $id) {
                $pv[] = Payment::where('id', $id)->get();
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
                    $pv->accountDebited = $value->accountdebited;
                    $pv->accountCredited = $value->accountcredited;
                    $pv->WHT = $value->wht;
                    $pv->nhil = $value->nhil;
                    $pv->payee = $value->payee;
                    $pv->currency = $value->currency;
                    $pv->status = "created";
                    $pv->vat = $value->vat;
                    $pv->withholding = $value->withholding;
                    $pv->creator = Auth::user()->id;
                    $pv->save();
                    return redirect('transactions');
                } else {
                    echo "Error";
                }
            }
        }
    }

}
