<?php
/**
 *  @author: Eric Korku Gbekor
 *  description: This controller communicates with the Account model to query the accounts table
*/


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\AccountClass;
use Response;

class AccountController extends Controller {

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
        $accounts = Account::get();
        return view('accountviews/tables', compact('accounts'));
    }

    /**
     * Save new resource into the storage .
     *@param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        $account = new Account();
        $account->id= $request->id;
        $account->account_name = $request->aname;
        $account->description = $request->description;
        $account->type = $request->type;
        $account->currency = $request->currency;
        $account->status = $request->status;
        $account->save();
        return redirect('account');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $account = Account::where('id', $id)->get();
        return $account->toJson();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        dd($request);
        $account = Account::findorfail($id);
        $account->account_name = $request->aname;
        $account->description = $request->description;
        $account->type = $request->type;
        $account->currency = $request->currency;
        $account->save();
        return response()->json($account);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Account::where('id', $id)->delete();
        return response()->json();
    }

    public function addAccount(){
        return view('accountviews.addaccount');
    }


    public function changeStatus(Request $request){
        if ($request->has('status')&&$request->has('id')){
            $id = $request->id;
            $status = $request->status;
            
            $supplier = Supplier::findorfail($id);
            
            if ($status=='enabled'){
                $supplier->status = 'disabled';
            }
            else
            {
                $supplier->status = 'enabled';
            }
            $supplier->save();
            return redirect('supplier');
        }
        
        else{
            echo "Error updating supplier status...";
        }
        
    }
}
