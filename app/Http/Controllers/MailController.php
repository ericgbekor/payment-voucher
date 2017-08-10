<?php

/**
 *  @author: Eric Korku Gbekor
 *  description: This controller performs mail notifications for the system
 */

namespace App\Http\Controllers;
use Carbon\Carbon;
use Response;
use Mail;
use App\User;
use App\Payment;
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

         $reviews = $request->count;
        $reviewers = User::where('status','enabled')->where('is_reviewer','yes')->orwhere('is_admin','yes')->select('email')->get()->toArray();

            Mail::to($reviewers)->queue(new reviewPV($reviews));

         return redirect()->back();
    }

    /**
     * Send mail notifictions to users to notify them about vouchers submitted for approval.
     * @param  \Illuminate\Http\Request  $request
     * @return redirect
     */
    public function sendApproveMail(Request $request) {

         $approve = $request->count;
        $approvers = User::where('status','enabled')->where('is_approver','yes')->orwhere('is_admin','yes')->select('email')->get()->toArray();

            Mail::to($approvers)->queue(new approvePV($approve));
         return redirect()->back();
    }

    /**
     * Send mail notifictions to users to notify them about voucher rejection.
     * @param  \Illuminate\Http\Request  $request
     * @return redirect
     */
    public function sendRejectMail(Request $request) {
        
        $rejects = $request->count;
        $creators = User::where('status','enabled')->where('is_creator','yes')->orwhere('is_admin','yes')->select('email')->get()->toArray();

            Mail::to($creators)->queue(new rejectPV($rejects));

         return redirect()->back();
    }
    

    /**
     * Send mail notifictions to users to notify them about voucher approval.
     * @param  \Illuminate\Http\Request  $request
     * @return redirect
     */
    public function approvalMail(Request $request) {

        $approval = $request->count;
        $creators = User::where('status','enabled')->where('is_creator','yes')->orwhere('is_admin','yes')->select('email')->get()->toArray();

            Mail::to($creators)->queue(new approvalPV($approval));

         return redirect()->back();
    }

}
