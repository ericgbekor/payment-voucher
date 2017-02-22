<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Account;
use App\Supplier;
use Response;
use Auth;
use PDF;
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
        $suppliers = Supplier::get();
        $accounts = Account::get();
        return view('pv-views/viewTransactions', compact('transactions','suppliers','accounts'));
    }
    
     public function reviewPayment() {
        $transactions = Payment::where('status','pending review')->get();
        return view('pv-views/reviewTransactions', compact('transactions'));
    }
    
    public function approvePayment() {
        $transactions = Payment::where('status','reviewed')->get();
        return view('pv-views/approveTransactions', compact('transactions'));
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
    
    

    public function genReport(){
    PDF::SetTitle('Payment Voucher');
    PDF::SetAuthor('Eric Gbekor');
    PDF::AddPage();
    PDF::Write(5, 'Hello World');
    PDF::Output('hello_world.pdf');
    }
    
    
    public function saveFile(Request $request) {
        if ($request->hasFile('documents')) {
            $name = $request->file('documents')->getClientOriginalName();
            $path = $request->file('documents')->storeAs('files', $name,'public');
            return $path;
        } else {
            echo "Error";
        }
    }

    public function getVAT($request) {
        if ($request->has('VAT')) {
            $req = $request->VAT;
            if ($req == "yes") {
                $amount = $request->amount;
                $vat = 0.175 * $amount;
            } else if ($req == "no") {
                $vat = 0.00;
            }

            return $vat;
        } else {
            echo "Error";
        }
    }

    public function getWHT($request) {
        if ($request->has('WHT')) {
            $req = $request->WHT;
            if ($req == "yes") {
                $amount = $request->amount;
                $witholding = 0.05 * $amount;
            } else if ($req == "no") {
                $witholding = 0.00;
            }
            return $witholding;
        } else {
            echo "Requset has no WHT in it";
        }
    }
    
    public function creditAcc(Request $request){
        if ($request->has('currency')){
           $currency = $request->currency; 
            if ($currency=='cedis'){
               $credit = 5001; 
            }
            else if ($currency == 'dollars'){
                $credit = 5002;
            }
            
            return $credit;
        }
        else{
            echo "No currency selected";
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request) {
        //dd($request);
        $pv = new Payment();
        $pv->amount = $request->amount;
        $pv->description = $request->description;
        $pv->rate = $request->rate;
        $pv->cheque = $request->cheque;
        $pv->accountDebited = $request->debit;
        $pv->accountCredited = $this->creditAcc($request);
        $pv->WHT = $request->WHT;
        $pv->nhil= $request->VAT;
        $pv->payee = $request->payee;
        $pv->currency = $request->currency;
        $pv->status = "created";
        $pv->attachments = $this->saveFile($request);
        $pv->vat = $this->getVAT($request);
        $pv->withholding = $this->getWHT($request);
        $pv->creator = Auth::user()->id;
        $pv->save();
        //return response()->json($pv);
        return redirect('transactions');
    }
    
    public function updatePV(Request $request){
        $id=$request->id;
        $pv = Payment::findorfail('id',$id);
        $pv->amount = $request->amount;
        $pv->description = $request->description;
        $pv->rate = $request->rate;
        $pv->cheque = $request->cheque;
        $pv->accountDebited = $request->debit;
        $pv->accountCredited = $this->creditAcc($request);
        $pv->WHT = $request->WHT;
        $pv->nhil= $request->VAT;
        $pv->payee = $request->payee;
        $pv->currency = $request->currency;
        $pv->status = "created";
        $pv->attachments = $this->saveFile($request);
        $pv->vat = $this->getVAT($request);
        $pv->withholding = $this->getWHT($request);
        $pv->creator = Auth::user()->id;
        $pv->save();
       return response()->json($pv);
    }

    public function deletePayment(Request $request) {
        $id = $request->id;
        Payment::where('id', $id)->delete();
        return response()->json();  
    }
    
    public function multiDelete(Request $request){
        
        if ($request->has('id')){
           foreach ($request->id as $id){
           Payment::where('id', $id)->delete();
           
             } 
        }
    }
    
    
    public function reviewStatus(Request $request){
        
        if($request->has('id')){
            
          foreach ($request->id as $id){
           $pv = Payment::findorfail($id);
           $pv->status = "pending review";
           $pv->save();
          }  
        }
    }
    
    public function review(Request $request){
        
        if($request->has('id')){
            
          foreach ($request->id as $id){
           $pv = Payment::findorfail($id);
           $pv->status = "reviewed";
           $pv->save();
          }  
        }
    }
    
    public function reject(Request $request){
        
        if($request->has('id')){
            
          foreach ($request->id as $id){
           $pv = Payment::findorfail($id);
           $pv->status = "rejected";
           $pv->save();
          }  
        }
    }
    
    public function approve(Request $request){
        
        if($request->has('id')){
            
          foreach ($request->id as $id){
           $pv = Payment::findorfail($id);
           $pv->status = "approved";
           $pv->save();
          }  
        }
    }

}
