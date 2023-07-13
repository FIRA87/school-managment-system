<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class StudentYearController extends Controller
{
    public function studentViewYear(){
        $data['allData'] = StudentYear::all();
        return view('backend.setup.year.view_year', $data);
    } // EMD METHOD

    public function studentYearAdd(){
        return view('backend.setup.year.add_year');
    }// EMD METHOD

    public function studentYearStore(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|unique:student_years,name',
        ]);
        $data = new StudentYear();
        $data->name = $request->name;
        $data->save();
        $notification = array(
            'message' => 'Student Year added successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.year.view')->with($notification);
    }// EMD METHOD

    public function studentYearEdit($id){
        $editData = StudentYear::findOrFail($id);
        return view('backend.setup.year.edit_year', compact('editData'));

    }// EMD METHOD

    public function studentYearUpdate(Request $request, $id){
        $data = StudentYear::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|unique:student_years,name,'.$data->id,
        ]);
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Year Updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.year.view')->with($notification);
    }// EMD METHOD

    public function studentYearDelete($id){
        $student = StudentYear::findOrFail($id);
        $student->delete();
        $notification = array(
            'message' =>'Student Year Deleted Successfully',
            'alert-type'=> 'info'
        );
        return redirect()->back()->with($notification);
    }// EMD METHOD

}
