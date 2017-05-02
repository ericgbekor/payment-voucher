<?php

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
                        ->get(), "pie", "fusioncharts")
                ->title("Credit Accounts Affected")
                ->elementLabel("Total")
                ->width(0)
                ->responsive(false)
                ->groupBy('account_name');

        $suppliers = Charts::database(DB::table('vouchers')
                        ->join('suppliers', 'payee', '=', 'suppliers.id')
                        ->select('vouchers.id', 'payee', 'supplier_name')
                        ->get(), "bar", "fusioncharts")
                ->title("Suppliers")
                ->elementLabel("Total")
                ->width(0)
                ->responsive(false)
                ->groupBy('supplier_name');

        $dept = Charts::database(DB::table('vouchers')
                        ->join('departments', 'department', '=', 'departments.id')
                        ->select('vouchers.id', 'departmentName')
                        ->get(), 'bar', 'fusioncharts')
                ->title("Departments")
                ->elementLabel("Vouchers Processed")
                ->width(0)
                ->responsive(false)
                ->groupBy('departmentName');


        $data = Summary::select('department', DB::raw('sum(amount) as amount'))->groupBy('department')
                ->get();
        $deptamount = Charts::create('pie', 'highcharts')
                ->title('Amount Spent By Departments')
                ->elementLabel('Amount')
                ->labels($data->pluck('department'))
                ->values($data->pluck('amount'))
                ->width(0)
                ->responsive(true);


        $status = Charts::database(Payment::all(), "pie", "fusioncharts")
                ->title("Status Breakdown")
                ->elementLabel("Total")
                ->width(0)
                ->responsive(false)
                ->groupBy('status');

        $vouchers = Charts::database(Payment::all(), "line", "fusioncharts")
                ->title("Vouchers Processed")
                ->elementLabel("Total")
                ->width(0)
                ->responsive(false)
                ->groupByMonth(2017, true);

        return view('index', compact('credit', 'suppliers', 'status', 'vouchers', 'chart', 'dept', 'deptamount'));
    }
    
    /**
     * Create chart variables by querying database tables.
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function chartPeriod(Request $request) {
        
        $start = $request->start;
        $start = $start.' 00:00:00';
         $end = $request->end;
         $end = $end.' 00:00:00';
        
        
        $credit = Charts::database(DB::table('vouchers')
                        ->join('accounts', 'accountCredited', '=', 'accounts.id')
                        ->select('vouchers.id', 'accountCredited', 'account_name')
                        ->whereBetween('vouchers.created_at',[$start,$end])
                        ->get(), "pie", "fusioncharts")
                ->title("Credit Accounts Affected")
                ->elementLabel("Total")
                ->width(0)
                ->responsive(false)
                ->groupBy('account_name');

        $suppliers = Charts::database(DB::table('vouchers')
                        ->join('suppliers', 'payee', '=', 'suppliers.id')
                        ->select('vouchers.id', 'payee', 'supplier_name')
                        ->whereBetween('vouchers.created_at',[$start,$end])
                        ->get(), "bar", "fusioncharts")
                ->title("Suppliers")
                ->elementLabel("Total")
                ->width(0)
                ->responsive(false)
                ->groupBy('supplier_name');

        $dept = Charts::database(DB::table('vouchers')
                        ->join('departments', 'department', '=', 'departments.id')
                        ->select('vouchers.id', 'departmentName')
                        ->whereBetween('vouchers.created_at',[$start,$end])
                        ->get(), 'bar', 'fusioncharts')
                ->title("Departments")
                ->elementLabel("Vouchers Processed")
                ->width(0)
                ->responsive(false)
                ->groupBy('departmentName');


        $data = Summary::select('department', DB::raw('sum(amount) as amount'))->groupBy('department')
                ->whereBetween('created_at',[$start,$end])
                ->get();
        $deptamount = Charts::create('pie', 'highcharts')
                ->title('Amount Spent By Departments')
                ->elementLabel('Amount')
                ->labels($data->pluck('department'))
                ->values($data->pluck('amount'))
                ->width(0)
                ->responsive(true);


        $status = Charts::database(Payment::whereBetween('created_at',[$start,$end])
                 ->get(), "pie", "fusioncharts")
                ->title("Status Breakdown")
                ->elementLabel("Total")
                ->width(0)
                ->responsive(false)
                ->groupBy('status');

        $vouchers = Charts::database(Payment::whereBetween('created_at',[$start,$end])
                 ->get(), "line", "fusioncharts")
                ->title("Vouchers Processed")
                ->elementLabel("Total")
                ->width(0)
                ->responsive(false)
                ->groupByMonth(2017, true);

        return view('index', compact('credit', 'suppliers', 'status', 'vouchers', 'chart', 'dept', 'deptamount'));
    }

}
