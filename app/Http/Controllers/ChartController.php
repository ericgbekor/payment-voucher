<?php
/**
 *  @author: Eric Korku Gbekor
 *  description: This controller queries the relevant tables to generate charts
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Charts;
use App\Payment;
use App\Summary;
use DB;

class ChartController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Create chart variables by querying database tables.
     * 
     * @return \Illuminate\Http\Response
     */
    public function charts() {
        
        $credit = Charts::database(DB::table('vouchers')
                        ->join('accounts', 'accountCredited', '=', 'accounts.id')
                        ->select('vouchers.id', 'accountCredited', 'account_name')
                        ->get(), "bar", "highcharts")
                ->title("Credit Accounts Affected")
                ->elementLabel("Total")
                ->width(0)
                ->responsive(false)
                ->groupBy('account_name');

        $suppliers = Charts::database(DB::table('vouchers')
                        ->join('suppliers', 'payee', '=', 'suppliers.id')
                        ->select('vouchers.id', 'payee', 'supplier_name' )
                        ->orderBy('vouchers.id','desc')
                        ->get(), "bar", "highcharts")
                ->title("Suppliers")
                ->elementLabel("Total")
                ->width(0)
                ->responsive(false)
                ->groupBy('supplier_name');

        $dept = Charts::database(DB::table('vouchers')
                        ->join('departments', 'department', '=', 'departments.id')
                        ->select('vouchers.id', 'deptname')
                        ->get(), 'bar', 'highcharts')
                ->title("Departments")
                ->elementLabel("Vouchers Processed")
                ->width(0)
                ->responsive(false)
                ->groupBy('deptname');


        $data = DB::table('vouchers')->join('departments', 'department', '=', 'departments.id')->select('department', DB::raw('sum(amount) as amount'))->groupBy('department')
                ->get();
        $deptamount = Charts::create('pie', 'highcharts')
                ->title('Amount Spent By Departments')
                ->elementLabel('Amount')
                ->labels($data->pluck('department'))
                ->values($data->pluck('amount'))
                ->width(0)
                ->responsive(false);


        $status = Charts::database(Payment::all(), "pie", "highcharts")
                ->title("Status Breakdown")
                ->elementLabel("Total")
                ->width(0)
                ->responsive(false)
                ->groupBy('status');

        $vouchers = Charts::database(Payment::all(), "line", "highcharts")
                ->title("Vouchers Processed")
                ->elementLabel("Total")
                ->width(0)
                ->responsive(false)
                ->groupByMonth(2018, true);

        return view('index', compact('credit', 'suppliers', 'status', 'vouchers', 'chart', 'dept', 'deptamount'));
    }
    
    /**
     * Create chart variables for a specific period by querying database tables.
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function chartPeriod(Request $request) {
        
        $start = $request->start;
        $start = $start.' 00:00:00';
         $end = $request->end;
         $end = $end.' 00:00:00';
        
      // dd($start." ". $end);  
        $credit = Charts::database(DB::table('vouchers')
                        ->join('accounts', 'accountCredited', '=', 'accounts.id')
                        ->select('vouchers.id', 'accountCredited', 'account_name')
                        ->whereBetween('vouchers.created_at',[$start,$end])
                        ->get(), "pie", "highcharts")
                ->title("Credit Accounts Affected")
                ->elementLabel("Total")
                ->width(0)
                ->responsive(false)
                ->groupBy('account_name');

        $suppliers = Charts::database(DB::table('vouchers')
                        ->join('suppliers', 'payee', '=', 'suppliers.id')
                        ->select('vouchers.id', 'payee', 'supplier_name')
                        ->whereBetween('vouchers.created_at',[$start,$end])
                        ->get(), "bar", "highcharts")
                ->title("Suppliers")
                ->elementLabel("Total")
                ->width(0)
                ->responsive(false)
                ->groupBy('supplier_name');

        $dept = Charts::database(DB::table('vouchers')
                        ->join('departments', 'department', '=', 'departments.id')
                        ->select('vouchers.id', 'deptname')
                        ->whereBetween('vouchers.created_at',[$start,$end])
                        ->get(), 'bar', 'highcharts')
                ->title("Departments")
                ->elementLabel("Vouchers Processed")
                ->width(0)
                ->responsive(false)
                ->groupBy('deptname');


        $data = Summary::select('department', DB::raw('sum(amount) as amount'))->groupBy('department')
                ->whereBetween('created_at',[$start,$end])
                ->get();
        $deptamount = Charts::create('pie', 'highcharts')
                ->title('Amount Spent By Departments')
                ->elementLabel('Amount')
                ->labels($data->pluck('department'))
                ->values($data->pluck('amount'))
                ->width(0)
                ->responsive(false);


        $status = Charts::database(Payment::whereBetween('created_at',[$start,$end])
                 ->get(), "pie", "highcharts")
                ->title("Status Breakdown")
                ->elementLabel("Total")
                ->width(0)
                ->responsive(false)
                ->groupBy('status');

        $vouchers = Charts::database(Payment::whereBetween('created_at',[$start,$end])
                 ->get(), "line", "highcharts")
                ->title("Vouchers Processed")
                ->elementLabel("Total")
                ->width(0)
                ->responsive(false)
                ->groupByMonth(2018, true);

        return view('index', compact('credit', 'suppliers', 'status', 'vouchers', 'chart', 'dept', 'deptamount'));
    }

}
