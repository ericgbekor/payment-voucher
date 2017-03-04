<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use DB;
use App\Payment;
use App\Supplier;

class PDFController extends Controller
{
    //
    
    public function headerFooter(){
    
    // Custom Header
        PDF::setHeaderCallback(function($pdf) {

            // Set font
            $pdf->SetFont('helvetica', 'B', 20);
            
            //logo image
            $pdf->Image('Ashesi.jpg',10,8,33);
            
            // Title
            $pdf->Cell(0, 15, 'Bank Payment Voucher', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        });

        // Custom Footer
        PDF::setFooterCallback(function($pdf) {
            $html ='©Ashesi University College. All rights reserved. 1 University Avenue, Berekuso; PMB CT 3, Cantonments, Accra, Ghana | Phone: +233.302.610.330';
            // Position at 15 mm from bottom
            $pdf->SetY(-15);
            // Set font
            $pdf->SetFont('helvetica', 'I', 8);
            // Page number
//            $pdf->Cell(0, 10, 'Page ' . $pdf->getAliasNumPage() . '/' . $pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
              $pdf->Cell(0, 10, $html, 0, false, 'C', 0, '', 0, false, 'T', 'M');
              
    });
    }
    
    
    public function genPDF() {
        
        $this->headerFooter();
        PDF::setHeaderMargin(10);
        PDF::setMargins(15,40,10);

        PDF::SetTitle('Voucher Details');
          $trans = Payment::where('id',56)->get();
         $payments = DB::table('payment-vouchers')
                    ->join('suppliers','payment-vouchers.payee','=','suppliers.id')
                    ->select('payment-vouchers.id','payee','supplier_name')
                    ->where('payment-vouchers.id',56)->get();
         
        $creator = DB::table('payment-vouchers')
                     ->join('users','creator','=','users.id')
                      -> select('payment-vouchers.id','creator','users.firstname','users.lastname')
                       ->where('payment-vouchers.id',56)->get();
        
        $reviewer = DB::table('payment-vouchers')
                     ->join('users','reviewer','=','users.id')
                      -> select('payment-vouchers.id','reviewer','users.firstname','users.lastname')
                       ->where('payment-vouchers.id',56)->get();
        
        $approver = DB::table('payment-vouchers')
                     ->join('users','approver','=','users.id')
                      -> select('payment-vouchers.id','approver','users.firstname','users.lastname')
                       ->where('payment-vouchers.id',56)->get();
        
       $credit = DB::table('payment-vouchers')
                     ->join('accounts','accountCredited','=','accounts.id')
                      -> select('payment-vouchers.id','accountCredited','account_name')
                       ->where('payment-vouchers.id',56)->get();
       
       $debit = DB::table('payment-vouchers')
                     ->join('accounts','accountDebited','=','accounts.id')
                      -> select('payment-vouchers.id','accountDebited','account_name')
                       ->where('payment-vouchers.id',56)->get();
                 
      $view = \View::make('pdf/report', compact('trans','payments','creator','reviewer','approver','credit','debit'));
        $html = $view->render();
       
        
       PDF::AddPage();
       PDF::writeHTML($html, true, false, true, false, '');

      
       
        PDF::Output('hello_world.pdf');


    }

}
