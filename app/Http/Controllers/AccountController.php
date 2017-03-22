<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use Response;

class AccountController extends Controller
{
    
    public function __construct()
{
    $this->middleware('auth');
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $accounts = Account::get();
        return view('accountviews/tables', compact('accounts'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $account = new Account();
        $account->id=$request->aid;
        $account->account_name = $request->aname;
        $account->account_class = $request->aclass;
        $account->save();
       return response()->json($account);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $account = Account::where('id', $id)->get();
        return $account->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
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
    public function destroy($id)
    {
        Account::where('id', $id)->delete();
        return response()->json();
    }
}
