<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentShift;
use Illuminate\Http\Request;

class StudentShiftController extends Controller
{

    public function studentViewShift(){
        $data['allData'] = StudentShift::all();
        return view('backend.setup.shift.view_shift', $data);
    } // EMD METHOD

    public function studentShiftAdd(){
        return view('backend.setup.shift.add_shift');
    }// EMD METHOD

    public function studentShiftStore(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|unique:student_shifts,name',
        ]);
        $data = new StudentShift();
        $data->name = $request->name;
        $data->save();
        $notification = array(
            'message' => 'Student Shift added successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.shift.view')->with($notification);
    }// EMD METHOD

    public function studentShiftEdit($id){
        $editData = StudentShift::findOrFail($id);
        return view('backend.setup.shift.edit_shift', compact('editData'));

    }// EMD METHOD

    public function studentShiftUpdate(Request $request, $id){
        $data = StudentShift::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|unique:student_shifts,name,'.$data->id,
        ]);
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Shift Updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.shift.view')->with($notification);
    }// EMD METHOD

    public function studentShiftDelete($id){
        $student = StudentShift::findOrFail($id);
        $student->delete();
        $notification = array(
            'message' =>'Student Shift Deleted Successfully',
            'alert-type'=> 'info'
        );
        return redirect()->back()->with($notification);
    }// EMD METHOD



}
