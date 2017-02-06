<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Account;
use App\Supplier;
use Response;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class TransactionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $transactions = Payment::get();
        return view('pv-views/viewTransactions', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $suppliers = Supplier::get();
        $accounts = Account::get();
        return view('pv-views/addTransactions', compact('suppliers', 'accounts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request) {
 //dd($request->file('documents')); 
 //echo $request->documents;
 //return $request->documents;
 //return $request->file('documents')->getClientOriginalName();
       /* 
        if ($request->hasFile('documents')){
            echo "true";
        }
        
        else
            echo "false";
*/
       
        if ($request->hasFile('documents')) {
            $path = $request->file('documents')->store('files');

            $pv = new Payment();
            $pv->amount = $request->amount;
            $pv->attachments = $path;
            $pv->description = $request->descripton;
            $pv->rate = $request->rate;
            $pv->cheque = $request->cheque;
            $pv->accountDebited = $request->debit;
            $pv->payee = $request->payee;
            $pv->save();
            return response()->json($pv);
        } else {
            echo "Error";
        }
    }

}
