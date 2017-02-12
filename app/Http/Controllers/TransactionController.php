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
    
    
    public function saveFile(Request $request)
    {
        if ($request->hasFile('documents')){
            $name = $request->file('documents')->getClientOriginalName();
            $path = $request->file('documents')->storeAs('files',$name);
            return $path;
        }
        else{
            echo "Error";
        }
    }
    
    public function getVAT($request){
        if ($request->has('VAT')){
          $req = $request->VAT;
            if($req=="yes"){
          $amount=$request->amount;
          $vat = 0.175*$amount;
         }
            else if ($req=="no"){
                $vat = 0.00;
            }
            
            return $vat;
        }
        else{echo "Error";}
    }
    
    public function getWHT ($request){
        if ($request->has('WHT')){
            $req = $request->WHT;
            if ($req=="yes")
            {
          $amount=$request->amount;
          $witholding = 0.05*$amount;
           }
           else if ($req=="no"){
               $witholding= 0.00;
           }
           return $witholding;
        }
        else{echo "Error";}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request) {  
       // dd($request);
        if ($request->has('description')){echo "True";}
        else{echo "False";}
       
            $pv = new Payment();
            $pv->amount = $request->amount;
            $pv->descriptions = $request->descripton;
            $pv->rate = $request->rate;
            $pv->cheque = $request->cheque;
            $pv->accountDebited = $request->debit;
            $pv->payee = $request->payee;
            $pv->status = "created";
            $pv->attachments = $this->saveFile($request);
            $pv->vat = $this->getVAT($request);
            $pv->withholding = $this->getWHT($request);
           // $pv->creator=Auth::user()->id;
            $pv->save();
            return response()->json($pv);
    }
    
    

}
