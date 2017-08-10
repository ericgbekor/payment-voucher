<?php

/**
 *  @author: Eric Korku Gbekor
 *  description: This controller communicates with the Supplier model to query the suppliers table
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use Validator;
use DB;
use Response;

class SupplierController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
       // $suppliers = Supplier::get();
        $suppliers = DB::table('suppliers')->get();
        return view('supplierviews.tables', compact('suppliers'));
    }

    /**
     * Save a new resource into storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        $supplier = new Supplier();
        $supplier->supplier_name = $request->sname;
        $supplier->description = $request->description;
        $supplier->status = $request->status;
        $supplier->save();
        return redirect('supplier');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $supplier = Supplier::where('id', $id)->get();
        return $supplier->toJson();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $supplier = Supplier::findorfail($id);
        $supplier->supplier_name = $request->name;
        $supplier->description = $request->description;
        $supplier->save();
        return response()->json($supplier);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        Supplier::where('id', $id)->delete();
        return response()->json();
    }

    public function addSupplier(){
        return view('supplierviews.addsupplier');
    }


    public function changeStatus(Request $request){
        if ($request->has('status')&&$request->has('id')){
            $id = $request->id;
            $status = $request->status;
            
            $supplier = Supplier::findorfail($id);
            
            if ($status=='enabled'){
                $supplier->status = 'disabled';
            }
            else
            {
                $supplier->status = 'enabled';
            }
            $supplier->save();
            return redirect('supplier');
        }
        
        else{
            echo "Error updating supplier status...";
        }
        
    }

}
