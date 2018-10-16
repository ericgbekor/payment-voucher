<?php

/**
 *  @author: Eric Korku Gbekor
 *  vouchers.description: This controller communicates with various model to query the tables that relate with voucher transactions
 */

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
        $transactions = Payment::join('suppliers','vouchers.payee','=','suppliers.id')
                        ->select('vouchers.id','vouchers.status','currency','amount','netpayable','withholding','vat','vouchers.description','rate','supplier_name as payee','department','cheque','accountDebited','accountCredited','creator','reviewer','approver','attachments','vouchers.created_at','vouchers.updated_at')
                        ->get();
        return view('pv-views.allTransactions', compact('transactions'));
    }

    public function view() {
        $transactions = Payment::join('suppliers','vouchers.payee','=','suppliers.id')
                        ->select('vouchers.id','vouchers.status','currency','amount','netpayable','withholding','vat','vouchers.description','rate','supplier_name as payee','department','cheque','accountDebited','accountCredited','creator','reviewer','approver','attachments','vouchers.created_at','vouchers.updated_at')
                        ->where('vouchers.status', 'created')->orwhere('vouchers.status', 'rejected')->get();
        $suppliers = Supplier::get();
        $reviewer = User::where('is_reviewer', 'yes')->orwhere('is_admin', 'yes')->get();
        $approver = User::where('is_approver', 'yes')->orwhere('is_admin', 'yes')->get();
        $debit = Account::all();
        $credit = Account::all();
        $depts = Department::get();
        return view('pv-views.viewTransactions', compact('transactions', 'suppliers', 'debit', 'depts', 'credit', 'reviewer', 'approver'));
    }

public function incomplete() {
        $transactions = Payment::join('suppliers','vouchers.payee','=','suppliers.id')
                        ->select('vouchers.id','vouchers.status','currency','amount','netpayable','withholding','vat','vouchers.description','rate','supplier_name as payee','department','cheque','accountDebited','accountCredited','creator','reviewer','approver','attachments','vouchers.created_at','vouchers.updated_at')->where('vouchers.status', 'incomplete')->get();
        $suppliers = Supplier::get();
        $reviewer = User::where('is_reviewer', 'yes')->orwhere('is_admin', 'yes')->get();
        $approver = User::where('is_approver', 'yes')->orwhere('is_admin', 'yes')->get();
        $debit = Account::all();
        $credit = Account::all();
        $depts = Department::get();
        return view('pv-views.incompleteTransactions', compact('transactions', 'suppliers', 'debit', 'depts', 'credit', 'reviewer', 'approver'));
    }

    /**
     * Display a listing of the resources with status "pending review".
     *
     * @return \Illuminate\Http\Response
     */
    public function reviewPayment() {
        
        $transactions = Payment::join('suppliers','vouchers.payee','=','suppliers.id')
                        ->select('vouchers.id','vouchers.status','currency','amount','netpayable','withholding','vat','vouchers.description','rate','supplier_name as payee','department','cheque','accountDebited','accountCredited','creator','reviewer','approver','attachments','vouchers.created_at','vouchers.updated_at')
                        ->where('vouchers.status', 'pending review')->get();
        return view('pv-views.reviewTransactions', compact('transactions'));
    }

    /**
     * Display a listing of the resources with status "approved".
     *
     * @return \Illuminate\Http\Response
     */
    public function makePayment() {
        $transactions = Payment::join('suppliers','vouchers.payee','=','suppliers.id')
                        ->select('vouchers.id','vouchers.status','currency','amount','netpayable','withholding','vat','vouchers.description','rate','supplier_name as payee','department','cheque','accountDebited','accountCredited','creator','reviewer','approver','attachments','vouchers.created_at','vouchers.updated_at')
                        ->where('vouchers.status', 'approved')->get();
        return view('pv-views.payTransactions', compact('transactions'));
    }

    /**
     * Display a listing of the resources with status "reviewed".
     *
     * @return \Illuminate\Http\Response
     */
    public function approvePayment() {
       $transactions = Payment::join('suppliers','vouchers.payee','=','suppliers.id')
                        ->select('vouchers.id','vouchers.status','currency','amount','netpayable','withholding','vat','vouchers.description','rate','supplier_name as payee','department','cheque','accountDebited','accountCredited','creator','reviewer','approver','attachments','vouchers.created_at','vouchers.updated_at')
                        ->where('vouchers.status', 'reviewed')->get();
        return view('pv-views.approveTransactions', compact('transactions'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request) {
        $id = $request->id;
//        $trans = Summary::where('id', $id)->get();
        $trans = Payment::where('id', $id)->get();

        $payments = Payment::join('suppliers', 'vouchers.payee', '=', 'suppliers.id')
                        ->select('vouchers.id', 'payee', 'supplier_name')
                        ->where('vouchers.id', $id)->get();
        
        $dept = Payment::join('departments', 'department', '=', 'departments.id')
                        ->select('vouchers.id', 'deptname as department')
                        ->where('vouchers.id', $id)->get();

        $credit = Payment::join('accounts', 'accountCredited', '=', 'accounts.id')
                        ->select('vouchers.id', 'accountCredited', 'account_name')
                        ->where('vouchers.id', $id)->get();

        $debit = Payment::join('accounts', 'accountDebited', '=', 'accounts.id')
                        ->select('vouchers.id', 'accountDebited', 'account_name')
                        ->where('vouchers.id', $id)->get();

        
        
        return view('pv-views.showTransaction', compact('trans','payments','debit','credit','dept'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //$suppliers = Supplier::get();
        $suppliers = DB::table('suppliers')->get();
        $debit = Account::get();
        $credit = Account::get();
        $depts = Department::get();
        $review = User::where('is_reviewer', 'yes')->orwhere('is_admin', 'yes')->where('status','enabled')->get();
        $approve = User::where('is_approver', 'yes')->orwhere('is_admin','yes')->where('status','enabled')->get();
        return view('pv-views.addTransactions', compact('suppliers', 'debit', 'credit', 'approve', 'review', 'depts'));
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

    public function getVAT(Request $request){
        if ($request->has('vat')){
            $vat = $request->vat;
            $amount = $request->amount;
            $vatcalc =($vat/100)*$amount;
            return $vatcalc;
        }
        else{
            $vat = $request->vat2;
            $amount = $request->amount;
            $vatcalc = ($vat/100)*$amount;
            return $vatcalc;
        }
    }


    public function getWHT(Request $request){

        if ($request->has('withholding')){
            $wht = $request->withholding;
            $amount = $request->amount;
            $whtcalc = ($wht/100)*$amount;
            return $whtcalc;
        }
        else{
            $wht = $request->withholding2;
            $amount = $request->amount;
            $whtcalc = ($wht/100)*$amount;
            return $whtcalc;
        }
    }

    /**
     * Generate netpayable value from gross amount, vat and withholding tax.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return double $net
     */
    public function getNetPayable(Request $request) {
        if ($request->has('amount')) {
            $amount = $request->amount;
            $vat = $this->getVAT($request);
            $wth = $this->getWHT($request);

            $net = ($amount - $wth) + $vat;
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
        return response()->download(storage_path("app/public/{$doc}"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return redirect
     */
    public function save(Request $request) {

        if (Auth::user()->is_creator=='yes' or Auth::user()->is_admin=='yes')
        {
        $pv = new Payment();
        $pv->amount = $request->amount;
        $pv->netpayable = $this->getNetPayable($request);
        $pv->description = $request->description;
        $pv->rate = $request->rate;
        $pv->cheque = $request->cheque;
        $pv->accountDebited = $request->debit;
        $pv->accountCredited = $request->credit;
        $pv->payee = $request->payee;
        $pv->department = $request->department;
        $pv->currency = $request->currency;
        $pv->status = "created";
        $pv->attachments = $this->saveFile($request);
        $pv->vat = $this->getVAT($request);
        $pv->withholding = $this->getWHT($request);
        $pv->creator = Auth::user()->id;
        $pv->reviewer = $request->reviewer;
        $pv->approver = $request->approver;
        $pv->save();
        return redirect('viewtransactions');
    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePV(Request $request) {
        if (Auth::user()->is_creator=='yes' or Auth::user()->is_admin=='yes')
        {
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
        $pv->department = $request->department;
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
    }

    public function addCheque(Request $request){

        if (Auth::user()->is_creator=='yes' or Auth::user()->is_admin=='yes')
        {
        $id = $request->id;
        $pv = Payment::findorfail($id);
        $pv->cheque = $request->cheque;
        $pv->creator = Auth::user()->id;
        $pv->save();
        return response()->json($pv);
    }

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
        if ($request->has('id')) {
            foreach ($request->id as $id) {
                $pv = Payment::findorfail($id);
                if ($pv->status == "created") {
                    $pv->status = "pending review";
                }
                $pv->save();
                
            }
        }
        // return json_encode($email);
    }

    /**
     * Update status of selected resources to "reviewed".
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array $email
     */
    public function review(Request $request) {
        if ($request->has('id')) {

            if (Auth::user()->is_reviewer == 'yes' || Auth::user()->is_admin=='yes' && Auth::user()->status=='enabled') {
                foreach ($request->id as $id) {
                    $pv = Payment::findorfail($id);
                    if ($pv->status == "pending review") {
                        $pv->status = "reviewed";
                    }
                    $pv->reviewer = Auth::user()->id;
                    $pv->save();
                    // $person = $this->getUserByID($pv->approver);
                    // $email[] = $person[0]->email;
                }
            }
        }
        // return json_encode($email);
    }

    /**
     * Update status of selected resources to rejected.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array $email
     */
    public function multireject(Request $request) {
        if ($request->has('id')) {
            if (Auth::user()->is_creator=='no' && Auth::user()->status=='enabled') {
                foreach ($request->id as $id) {
                    $pv = Payment::findorfail($id);
                    $pv->status = "rejected";
                    $pv->save();
                    // $person = $this->getUserByID($pv->creator);
                    // $email[] = $person[0]->email;
                }
            }
        }
        // return json_encode($email);
    }

    /**
     * Update the status of selected resources to approved
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array $email
     */
    public function approve(Request $request) {
        if ($request->has('id')) {
            if (Auth::user()->is_approver == 'yes' || Auth::user()->is_admin == 'yes' && Auth::user()->status=='enabled') {
                foreach ($request->id as $id) {
                    $pv = Payment::findorfail($id);
                    if ($pv->status == "reviewed") {
                        $pv->status = "approved";
                    }
                    $pv->approver = Auth::user()->id;
                    $pv->save();
                    // $person = $this->getUserByID($pv->creator);
                    // $email[] = $person[0]->email;
                }
            }
        }
        // return json_encode($email);
    }

}
