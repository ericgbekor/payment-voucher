<?php

/**
 *  @author: Eric Korku Gbekor
 *  description: This controller communicates with the relevant models to perform PDF export
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use DB;
use App\Payment;
use App\Supplier;
use App\Summary;
use Carbon\Carbon;
use NumberToWords\NumberToWords;

class PDFController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Setting Header and Footer of the PDF Document.
     * 
     * @return void
     */
    public function headerFooter() {

        // Custom Header
        PDF::setHeaderCallback(function($pdf) {

            // Set font
            $pdf->SetFont('helvetica', 'B', 20);

            //logo image
            $pdf->Image('Ashesi.jpg', 10, 8, 33);

            // Title
            $pdf->Cell(0, 15, 'Bank Payment Voucher', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        });

        // Custom Footer
        PDF::setFooterCallback(function($pdf) {
            $html = '©Ashesi University College. All rights reserved.  1 University Avenue, Berekuso; PMB CT 3, Cantonments, Accra, Ghana | Phone: +233.302.610.330';
            // Position at 15 mm from bottom
            $pdf->SetY(-15);
            // Set font
            $pdf->SetFont('helvetica', 'I', 8);
            // Page number
//            $pdf->Cell(0, 10, 'Page ' . $pdf->getAliasNumPage() . '/' . $pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
            $pdf->Cell(0, 10, $html, 0, false, 'C', 0, '', 0, false, 'T', 'M');
        });
    }

    /**
     * Set body elements of PDF and render HTML view in PDF format.
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function genPDF(Request $request) {
        $id = $request->id;
        // create the number to words "manager" class
        $numberToWords = new NumberToWords();

        //build a new number transformer to convert number to words
        $pv = Payment::where('id', $id)->get();
        $numberTrans = $numberToWords->getNumberTransformer('en');
        $numWords = $numberTrans->toWords($pv[0]->amount);

        $this->headerFooter();
        PDF::setHeaderMargin(10);
        PDF::setMargins(15, 40, 10);

        // set title of PDF
        PDF::SetTitle('Voucher Details');
        $trans = Payment::where('id', $id)->get();

        $payments = DB::table('vouchers')
                        ->join('suppliers', 'vouchers.payee', '=', 'suppliers.id')
                        ->select('vouchers.id', 'payee', 'supplier_name')
                        ->where('vouchers.id', $id)->get();

        $creator = DB::table('vouchers')
                        ->join('users', 'creator', '=', 'users.id')
                        ->select('vouchers.id', 'creator', 'users.firstname', 'users.lastname')
                        ->where('vouchers.id', $id)->get();

        $reviewer = DB::table('vouchers')
                        ->join('users', 'reviewer', '=', 'users.id')
                        ->select('vouchers.id', 'reviewer', 'users.firstname', 'users.lastname')
                        ->where('vouchers.id', $id)->get();

        $approver = DB::table('vouchers')
                        ->join('users', 'approver', '=', 'users.id')
                        ->select('vouchers.id', 'approver', 'users.firstname', 'users.lastname')
                        ->where('vouchers.id', $id)->get();
        
        $dept = DB::table('vouchers')
                        ->join('departments', 'department', '=', 'departments.id')
                        ->select('vouchers.id', 'departmentName as department')
                        ->where('vouchers.id', $id)->get();

        $credit = DB::table('vouchers')
                        ->join('accounts', 'accountCredited', '=', 'accounts.id')
                        ->select('vouchers.id', 'accountCredited', 'account_name')
                        ->where('vouchers.id', $id)->get();

        $debit = DB::table('vouchers')
                        ->join('accounts', 'accountDebited', '=', 'accounts.id')
                        ->select('vouchers.id', 'accountDebited', 'account_name')
                        ->where('vouchers.id', $id)->get();

        // get the current time  
        $current = Carbon::now();


        $pdf = \View::make('pdf.report', compact('current', 'dept', 'trans', 'payments', 'creator', 'reviewer', 'approver', 'credit', 'debit', 'numWords'));

        //render html file
        $html = $pdf->render();

        // add pdf page
        PDF::AddPage();

        //write html file into pdf format
        PDF::writeHTML($html, true, false, true, false, '');


        PDF::Output('voucher.pdf');
    }

}
