<?php
/**
 *  @author: Eric Korku Gbekor
 *  description: This controller communicates with the Department model to query the departments table
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;

class DeptController extends Controller {

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
        //
        $depts = Department::get();
        return view('deptviews.departments', compact('depts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        //
        $dept = new Department();
        $dept->deptname = $request->deptname;
        $dept->description=$request->description;
        $dept->status = $request->status;
        $dept->save();
        return redirect('department');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $dept = Department::findorfail($request->id);
        $dept->deptname = $request->deptname;
        $dept->description=$request->description;
        $dept->save();
        return response()->json($dept);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        Department::where('id', $id)->delete();
        return response()->json();
    }

    public function addDepartment(){
        return view('deptviews.newdepartment');
    }


    public function changeStatus(Request $request){
        if ($request->has('status')&&$request->has('id')){
            $id = $request->id;
            $status = $request->status;
            
            $dept = Department::findorfail($id);
            
            if ($status=='enabled'){
                $dept->status = 'disabled';
            }
            else
            {
                $dept->status = 'enabled';
            }
            $dept->save();
            return redirect('department');
        }
        
        else{
            echo "Error updating department status...";
        }
        
    }

}
