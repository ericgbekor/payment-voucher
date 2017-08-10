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

         $reviews = Payment::where('status','pending review')->count();
        $reviewers = User::where('role','2')->orwhere('role','4')->where('status','enabled')->get();

        foreach ($reviewers as $reviewer){

            Mail::to($reviewer->email)->queue(new reviewPV($reviews));
        }

         return redirect()->back();
    }

    /**
     * Send mail notifictions to users to notify them about vouchers submitted for approval.
     * @param  \Illuminate\Http\Request  $request
     * @return redirect
     */
    public function sendApproveMail(Request $request) {

         $approve = Payment::where('status','reviewed')->count();
        $approvers = User::where('role','3')->orwhere('role','4')->where('status','enabled')->get();

        foreach ($approvers as $approver){

            Mail::to($approver->email)->queue(new approvePV($approve));
        }

         return redirect()->back();
    }

    /**
     * Send mail notifictions to users to notify them about voucher rejection.
     * @param  \Illuminate\Http\Request  $request
     * @return redirect
     */
    public function sendRejectMail(Request $request) {
        
        $rejects = Payment::where('status','rejected')->count();
        $creators = User::where('role','1')->orwhere('role','4')->where('status','enabled')->get();

        foreach ($creators as $creator){

            Mail::to($creator->email)->queue(new rejectPV($rejects));
        }

         return redirect()->back();
    }

    /**
     * Send mail notifictions to users to notify them about voucher approval.
     * @param  \Illuminate\Http\Request  $request
     * @return redirect
     */
    public function approvalMail(Request $request) {

        $approved = Payment::where('status','approved')->count();
        $creators = User::where('role','1')->orwhere('role','4')->where('status','enabled')->get();

        foreach ($creators as $creator){

            Mail::to($creator->email)->queue(new approvalPV($reviews));
        }

         return redirect()->back();
    }

}
