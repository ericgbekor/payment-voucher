<?php

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
        $dept->departmentName = $request->name;
        $dept->save();
        return response()->json($dept);
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
        $dept->departmentName = $request->name;
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

}
