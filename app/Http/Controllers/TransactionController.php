<?php

namespace App\Http\Controllers;
use DB;
use App\Payment;
use App\Account;
use App\Supplier;
use App\User;
use App\Department;
use Response;
use App\Summary;
use Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class TransactionController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $transactions = Summary::all();
        return view('pv-views.allTransactions', compact('transactions'));
    }
    
    public function view() {
        $transactions = Summary::where('status', 'created')->orwhere('status', 'rejected')->get();
        $suppliers = Supplier::get();
        $reviewer = User::where('role', '2')->orwhere('role', '4')->get();
        $approver = User::where('role', '3')->orwhere('role', '4')->get();
        $debit = Account::where('account_class','debit')->get();
        $credit = Account::where('account_class','credit')->get();
        $depts = Department::get();


        return view('pv-views.viewTransactions', compact('transactions', 'suppliers', 'debit','depts','credit','reviewer','approver'));
    }

     /**
     * Display a listing of the resources with status "pending review".
     *
     * @return \Illuminate\Http\Response
     */
    public function reviewPayment() {

        $transactions = Summary::where('status', 'pending review')->get();
        return view('pv-views/reviewTransactions', compact('transactions'));
    }

     /**
     * Display a listing of the resources with status "approved".
     *
     * @return \Illuminate\Http\Response
     */
    public function makePayment() {
        $transactions = Summary::where('status', 'approved')->get();
        return view('pv-views/payTransactions', compact('transactions'));
    }

     /**
     * Display a listing of the resources with status "reviewed".
     *
     * @return \Illuminate\Http\Response
     */
    public function approvePayment() {
        $transactions = Summary::where('status', 'reviewed')->get();
        return view('pv-views/approveTransactions', compact('transactions'));
    }
    
     /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function show(Request $request) {
         $id = $request->id;
//         $voucher = Payment::where('id',$id)->get();
        $trans = Summary::where('id',$id)->get();
        return view('pv-views.showTransaction', compact('trans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $suppliers = Supplier::get();
        $debit = Account::where('account_class','debit')->get();
        $credit = Account::where('account_class','credit')->get();
        $depts = Department::get();
        $review = User::where('role', '2')->orwhere('role', '4')->get();
        $approve = User::where('role', '3')->orwhere('role', '4')->get();
        return view('pv-views.addTransactions', compact('suppliers', 'debit','credit', 'approve', 'review','depts'));
    }

    /**
     * Get path of file to be saved on the file system.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string $path
     */
    public function saveFile(Request $request) {
        $path = [];
        if ($request->hasFile('documents')) {
            $docs = $request->file('documents');
            foreach ($docs as $doc) {
                $name = $doc->getClientOriginalName();
                $path = $doc->storeAs('files', $name, 'public');
            }
            return $path;
        } else {
            echo "Error";
        }
    }

    /**
     * Generate netpayable value from gross amount, vat and withholding tax.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return double $net
     */
    public function getNetPayable($request) {
        if ($request->has('amount')) {
            $amount = $request->amount;
            $vat = $request->vat;
            $wth = $request->withholding;

            $net = $amount - $wth + $vat;
            return $net;
        }
    }


    /**
     * Get user details.
     *
     * @param  int $id
     * @return array $person
     */
    public function getUserByID($id) {
        $person = User::where('id', $id)->get();
        return $person;
    }

    
    /**
     * Get path of file stored on file system and download it.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function downloadFile(Request $request) {
        $id = $request->id;
        $pv = Payment::findorfail($id);
        $doc = $pv->attachments;
        return response()->download("storage/" . $doc);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return redirect
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
        $pv->department=$request->department;
        $pv->currency = $request->currency;
        $pv->status = "created";
        $pv->attachments = $this->saveFile($request);
        $pv->vat = $request->vat;
        $pv->withholding = $request->withholding;
        $pv->creator = Auth::user()->id;
        $pv->reviewer = $request->reviewer;
        $pv->approver = $request->approver;
        $pv->save();
        return redirect('transactions');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePV(Request $request) {
        $id = $request->id;
        $pv = Payment::findorfail($id);
        $pv->amount = $request->amount;
        $pv->netpayable = $this->getNetPayable($request);
        $pv->description = $request->description;
        $pv->rate = $request->rate;
        $pv->cheque = $request->cheque;
        $pv->accountDebited = $request->debit;
        $pv->accountCredited = $request->credit;
        $pv->payee = $request->payee;
        $pv->department=$request->department;
        $pv->currency = $request->currency;
        $pv->status = "created";
        $pv->attachments = $this->saveFile($request);
        $pv->vat = $request->vat;
        $pv->withholding = $request->withholding;
        $pv->creator = Auth::user()->id;
        $pv->reviewer = $request->reviewer;
        $pv->approver = $request->approver;
        $pv->save();
        return response()->json($pv);
    }


    /**
     * Remove the specified resources from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function multiDelete(Request $request) {

        if ($request->has('id')) {
            foreach ($request->id as $id) {
                Payment::where('id', $id)->delete();
            }
        }
    }

    
    /**
     * Update status of selected resources to "pending review".
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array $email
     */
    public function reviewStatus(Request $request) {
        $email = array();
        if ($request->has('id')) {
            foreach ($request->id as $id) {
                $pv = Payment::findorfail($id);
                if ($pv->status == "created") {
                    $pv->status = "pending review";
                }
                $pv->save();
                $person = $this->getUserByID($pv->reviewer);
                $email[] =  $person[0]->email;
            }
        }
        return json_encode($email);
        
    }

    /**
     * Update status of selected resources to "reviewed".
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array $email
     */
    public function review(Request $request) {
         $email = array();
        if ($request->has('id')) {

            if (Auth::user()->role != 1) {
                foreach ($request->id as $id) {
                    $pv = Payment::findorfail($id);
                    if ($pv->status=="pending review"){
                    $pv->status = "reviewed";
                    }
                    $pv->reviewer = Auth::user()->id;
                    $pv->save();
                    $person = $this->getUserByID($pv->approver);
                    $email[] =  $person[0]->email;                }
            }
        }
        return json_encode($email);
    }



    /**
     * Update status of selected resources to rejected.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array $email
     */
    public function multireject(Request $request) {
        $email = array();
        if ($request->has('id')) {
            if (Auth::user()->role != 1) {
                foreach ($request->id as $id) {
                    $pv = Payment::findorfail($id);
                    $pv->status = "rejected";
                    $pv->save();
                    $person = $this->getUserByID($pv->creator);
                    $email[] =  $person[0]->email;
                    
                }
            }
        } 
        return json_encode($email);
    }


    /**
     * Update the status of selected resources to approved
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array $email
     */
     public function approve(Request $request){
          $email = array();
         if($request->has('id')){ 
             if(Auth::user()->role==3|| Auth::user()->role==4){ 
           foreach ($request->id as $id){
            $pv = Payment::findorfail($id);
            if($pv->status=="reviewed"){
            $pv->status = "approved";
            }
            $pv->approver = Auth::user()->id;
            $pv->save();
             $person = $this->getUserByID($pv->creator);
             $email[] =  $person[0]->email;
           }  
             }
         }
         return json_encode($email);
     }
}
