<?php

/**
 *  @author: Eric Korku Gbekor
 *  description: This controller performs mail notifications for the system
 */

namespace App\Http\Controllers;

use Response;
use Mail;
use App\Mail\reviewPV;
use App\Mail\approvePV;
use App\Mail\rejectPV;
use App\Mail\approvalPV;
use Illuminate\Http\Request;

class MailController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Send mail notifictions to users to notify them about vouchers submitted for review.
     * @param  \Illuminate\Http\Request  $request
     * @return redirect
     */
    public function sendReviewMail(Request $request) {
        if ($request->has('email')) {
            $email = $request->email;
            $emails = json_decode($email);
            for ($i = 0; $i < count($emails); $i++) {
                $mail = $emails[$i];
                Mail::to($mail)->queue(new reviewPV);
            }
        }
         return redirect()->back();
    }

    /**
     * Send mail notifictions to users to notify them about vouchers submitted for approval.
     * @param  \Illuminate\Http\Request  $request
     * @return redirect
     */
    public function sendApproveMail(Request $request) {
        if ($request->has('email')) {
            $email = $request->email;
            $emails = json_decode($email);
            for ($i = 0; $i < count($emails); $i++) {
                $mail = $emails[$i];
                Mail::to($mail)->queue(new approvePV);
            }
        }
         return redirect()->back();
    }

    /**
     * Send mail notifictions to users to notify them about voucher rejection.
     * @param  \Illuminate\Http\Request  $request
     * @return redirect
     */
    public function sendRejectMail(Request $request) {
        if ($request->has('email')) {
            $email = $request->email;
            $emails = json_decode($email);
            for ($i = 0; $i < count($emails); $i++) {
                $mail = $emails[$i];
                Mail::to($mail)->queue(new rejectPV);
            }
        }
        return redirect()->back();
    }

    /**
     * Send mail notifictions to users to notify them about voucher approval.
     * @param  \Illuminate\Http\Request  $request
     * @return redirect
     */
    public function approvalMail(Request $request) {
        if ($request->has('email')) {
            $email = $request->email;
            $emails = json_decode($email);
            for ($i = 0; $i < count($emails); $i++) {
                $mail = $emails[$i];
                Mail::to($mail)->queue(new approvalPV);
            }
        }
        return redirect()->back();
    }

}
