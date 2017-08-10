<?php

/**
 *  @author: Eric Korku Gbekor
 *  description: This controller communicates with the User model to query the users table
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Response;
use Auth;
use Hash;

class UserController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $users = User::get();
       // dd($users);
        return view('userviews.tables', compact('users'));
    }

    /**
     * Show form for creating new resource.
     *
     * 
     */
    public function showForm() {
        return view('userviews.useradd');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(Request $request) {
        return Validator::make($request->all(), [
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|min:6|confirmed',
                ])->validate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return redirect
     */
    public function store(Request $request) {
       // dd($request);
        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;

        $role = $request->role;
        if ($role==1){
             $user->is_creator=='yes';
              $user->is_reviewer=='no';
               $user->is_approver=='no';
                $user->is_admin=='no';
        }
       
       elseif ($role==2){
         $user->is_reviewer = 'yes';
          $user->is_creator=='no';
            $user->is_approver=='no';
                $user->is_admin=='no';
       }

       elseif ($role==3){
         $user->is_approver = 'yes';
          $user->is_reviewer=='no';
               $user->is_creator=='no';
                $user->is_admin=='no';
       }

       else{
         $user->is_admin = 'yes';
          $user->is_reviewer=='no';
               $user->is_approver=='no';
                $user->is_creator=='no';
       }
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
    public function update(Request $request, $id) {
        $user = User::findorfail($id);
        $user->username = $request->name;
        $user->email = $request->mail;
        $user->firstname = $request->fname;
        $user->lastname = $request->lname;
        $user->role = $request->role;
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
    public function destroy($id) {
        User::where('id', $id)->delete();
        return response()->json();
    }

    
    public function changePassword(Request $request){          
        $user = User::findorfail(Auth::user()->id);
        if (Hash::check($request->oldpassword, $user->password) && $request->has('newpassword') && $request->has('confirm')){
                $user->password = bcrypt($request->newpassword);
                $user->save();
          return redirect('home');
          
        }
        else{
            echo('Error...Password not changed');
        }
    }
    
    
    public function changeStatus(Request $request){
        if ($request->has('status')&&$request->has('id')){
            $id = $request->id;
            $status = $request->status;
            
            $user = User::findorfail($id);
            
            if ($status=='enabled'){
                $user->status = 'disabled';
            }
            else
            {
                $user->status = 'enabled';
            }
            $user->save();
            return redirect('user');
        }
        
        else{
            echo "Error updating user status...";
        }
        
    }
}
