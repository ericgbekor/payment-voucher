<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Account;
use App\Supplier;
use App\User;
use Response;
use App\Summary;
use Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class TransactionController extends Controller {

    public function __construct()
{
    $this->middleware('auth');
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $transactions = Summary::where('status','created')->orwhere('status','rejected')->get();
        $suppliers = Supplier::get();
        $accounts = Account::get();
        
        return view('pv-views.viewTransactions', compact('transactions','suppliers','accounts'));
    }
    
     public function reviewPayment() {

        $transactions = Summary::where('status','pending review')->get();
        return view('pv-views/reviewTransactions', compact('transactions'));
    }
    
     public function makePayment() {
        $transactions = Summary::where('status','approved')->get();
        return view('pv-views/payTransactions', compact('transactions'));
    }
    
    public function approvePayment() {
        $transactions = Summary::where('status','reviewed')->get();
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
         $review = User::where('role','2')->orwhere('role','4')->get();
        $approve = User::where('role','3')->orwhere('role','4')->get();
        return view('pv-views.addTransactions', compact('suppliers', 'accounts','approve','review'));
    }
    

    public function saveFile(Request $request) {
        $path = [];
        if ($request->hasFile('documents')) {
            $docs = $request->file('documents');
            foreach ($docs as $doc){
            $name = $doc ->getClientOriginalName();
            $path  = $doc ->storeAs('files', $name, 'public');
            }
            return $path;
            }
         else {
            echo "Error";
        }
    }

    public function getNetPayable($request) {
        if ($request->has('amount')) {
           $amount=$request->amount;
           $vat = $request->vat;
           $wth = $request->withholding;
           
           $net = $amount-($vat+$wth);
           return $net;
    }

    }
    
    public function getUser($user){
        $person = User::where('email',$user)->get();
        return $person;   
    }


    public function getUserByID($id){
        $person = User::where('id',$id)->get();
        return $person; 
    }

    
    public function downloadFile(Request $request){
        $id = $request->id;
        $pv = Payment::findorfail($id);
        $doc = $pv -> attachments;
        return response()->download("storage/".$doc);
    }


    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request) {
        $pv = new Payment();
        $pv->amount = $request->amount;
        $pv->netpayable = $this->getNetPayable($request);
        $pv->description = $request->description;
        $pv->rate = $request->rate;
        $pv->cheque = $request->cheque;
        $pv->accountDebited = $request->debit;
        $pv->accountCredited = $request->credit;
        $pv->payee = $request->payee;
        $pv->currency = $request->currency;
        $pv->status = "created";
        $pv->attachments = $this->saveFile($request);
        $pv->vat = $request->vat;
        $pv->withholding = $request->withholding;
        $pv->creator = Auth::user()->id;
        $pv->save();
       return redirect('transactions');
    }
    
    public function updatePV(Request $request){
        $id=$request->id;
        $pv = Payment::findorfail($id);
        $pv->amount = $request->amount;
        $pv->netpayable = $this->getNetPayable($request);
        $pv->description = $request->name;
        $pv->rate = $request->rate;
        $pv->cheque = $request->cheque;
        $pv->accountDebited = $request->debit;
        $pv->accountCredited = $this->creditAcc($request);
//        $pv->payee = $request->payee;
        $pv->currency = $request->currency;
        $pv->status = "created";
        $pv->attachments = $this->saveFile($request);
        $pv->vat = $request->vat;
        $pv->withholding = $request->withholding;
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
            $reviewer=$request->rev;
            $person = $this->getUser($reviewer); 
           foreach ($request->id as $id){
           $pv = Payment::findorfail($id);
           if ($pv->status=="created"){
           $pv->status = "pending review";}
          // $pv->reviewer = $person[0]->id;
           $pv->save();
           
           
          }
          
        }
        return $person[0]->email;
       // return redirect('/reviewmail');
    }
    
    public function review(Request $request){
        // dd($request);
        if($request->has('id')){
           
          if(Auth::user()->role!=1){
          foreach ($request->id as $id){
           $pv = Payment::findorfail($id);
           $pv->status = "reviewed";
           $pv->reviewer = Auth::user()->id;
           $pv->save();
            $reviewer=$request->app;
            $person = $this->getUser($reviewer); 
            $email = $person[0]->email;
           
          }
          
          }  
        }
         return $email;
//        return redirect('/approvemail');
    }
    

    public function reject(Request $request) {
        if ($request->has('id')){
        $id = $request->id;
        
        

        if(Auth::user()->role!=1){ 
        $pv = Payment::findorfail($id);
        
         $pv->status = "rejected";
          $pv->save();
          $person= $this->getUserByID($pv->creator);
          $email = $person[0]->email;
              }
    }
        return $email;
    }


    public function multireject(Request $request){
       
        if($request->has('id')){
           if(Auth::user()->role!=1){ 
          foreach ($request->id as $id){
           $pv = Payment::findorfail($id);
           $pv->status = "rejected";
           $pv->save();
          
          }
          }  
        }
        return redirect('/rejectmail');
    }
    
    public function approve(Request $request){
        
        if($request->has('id')){ 
            if(Auth::user()->role==3|| Auth::user()->role==4){ 
          foreach ($request->id as $id){
           $pv = Payment::findorfail($id);
           $pv->status = "approved";
           $pv->approver = Auth::user()->id;
           $pv->save();
          
          }  
            }
        }
        return redirect('/approvalmail');
    }
    

}
