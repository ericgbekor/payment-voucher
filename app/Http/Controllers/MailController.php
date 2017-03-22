<?php

namespace App\Http\Controllers;
use Mail;
use App\Mail\reviewPV;
use App\Mail\approvePV;
use App\Mail\rejectPV;
use App\Mail\approvalPV;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}
    
    //
    function sendReviewMail(Request $request)
    {
        if ($request->has('email')){
        $mail = $request->email;
    Mail::to($mail)->queue(new reviewPV);
    return redirect('/transactions');
        }
    }
    
    function sendApproveMail(Request $request)
    {
        if ($request->has('email')){
        $mail = $request->email;
        Mail::to($mail)->queue(new approvePV);
    return redirect('/approveTrans');
    }
    }
    function sendRejectMail(Request $request)
    {if ($request->has('email')){
        $mail = $request->email;
    Mail::to($mail)->queue(new rejectPV);
        return redirect('/reviewTrans');
            }
    }
    
    function approvalMail(Request $request)
    {
       if ($request->has('email')){
        $mail = $request->email;
    Mail::to($mail)->queue(new approvalPV);
    dd('Mail sent successfully');
}
    }
}
