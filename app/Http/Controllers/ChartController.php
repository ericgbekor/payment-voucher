<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Charts;
use App\Payment;
use DB;

class ChartController extends Controller
{
    //
    
    public function charts(){
      
        $credit = Charts::database(DB::table('vouchers')
                     ->join('accounts','accountCredited','=','accounts.id')
                      -> select('vouchers.id','accountCredited','account_name')
                      ->get(),"pie","chartjs")
                ->title("Credit Accounts Affected")
                ->elementLabel("Total")
                ->width(0)
                ->responsive(false)
                ->groupBy('account_name');
        
        $suppliers = Charts::database(DB::table('vouchers')
                    ->join('suppliers','payee','=','suppliers.id')
                    ->select('vouchers.id','payee','supplier_name')
                   ->get(),"bar","fusioncharts")
                ->title("Suppliers")
                ->elementLabel("Total")
                ->width(0)
                ->responsive(false)
                ->groupBy('supplier_name');
        
        $status = Charts::database(Payment::all(),"pie","fusioncharts")
                ->title("Status Breakdown")
                ->elementLabel("Total")
                ->width(0)
                ->responsive(false)
                ->groupBy('status');
        
        $vouchers = Charts::database(Payment::all(),"line","morris")
                ->title("Vouchers Processed")
                ->elementLabel("Total")
                ->width(0)
                ->responsive(false)
                ->groupByMonth(2017,true);
        
        return view('index',compact('credit','suppliers','status','vouchers','chart'));
        
    } 
}
