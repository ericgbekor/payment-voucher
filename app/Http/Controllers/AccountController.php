<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
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
        $account->id = $request->aid;
        $account->account_name = $request->aname;
        $account->account_class = $request->aclass;
        $account->save();
        return response()->json($account);
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
        $account = Account::findorfail($id);
        $account->account_name = $request->name;
        $account->account_class = $request->class;
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

}
