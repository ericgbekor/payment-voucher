<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Response;

class UserController extends Controller
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
         $users = User::get();
        return view('userviews.tables',compact('users'));
    }
    
    /**
     * Show form for creating new resource.
     *
     * 
     */
    public function showForm(){
        return view('userviews.useradd');
    }
    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            //'usergroup' => 'required|max:255',
            
        ])->validate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return redirect
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request->password;
        $user -> usertype = $request->usertype;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->role=$request->role;
        $user->status = $request->status;
        $user->save();
        return redirect('user');
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
        $user= User::findorfail($id);
        $user->username = $request->name;
        $user->email = $request->mail;
        $user -> usertype = $request->type;
        $user->firstname = $request->fname;
        $user->lastname = $request->lname;
        $user->role=$request->role;
        $user->status = $request->status;
        $user->save();
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return response()->json();
    }
    
}
