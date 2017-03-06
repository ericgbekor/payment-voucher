<?php

namespace App\Http\Controllers;
use Mail;
use App\Mail\reviewPV;

use Illuminate\Http\Request;

class MailController extends Controller
{
    //
    function sendMail()
    {
        $mail = 'eric.gbekor@ashesi.edu.gh';
    Mail::to($mail)->send(new reviewPV);
    dd('Mail sent successfully');
    }
}
