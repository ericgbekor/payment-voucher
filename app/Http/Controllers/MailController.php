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
    //
    function sendReviewMail()
    {
        $mail = 'eric.gbekor@ashesi.edu.gh';
    Mail::to($mail)->send(new reviewPV);
    
    }
    
    function sendApproveMail()
    {
        $mail = 'eric.gbekor@ashesi.edu.gh';
    Mail::to($mail)->send(new approvePV);
    dd('Mail sent successfully');
    }
    
    function sendRejectMail()
    {
        $mail = 'eric.gbekor@ashesi.edu.gh';
    Mail::to($mail)->send(new rejectPV);
    dd('Mail sent successfully');
    }
    
    function approvalMail()
    {
        $mail = 'eric.gbekor@ashesi.edu.gh';
    Mail::to($mail)->send(new approvalPV);
    dd('Mail sent successfully');
    }
}
