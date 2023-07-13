<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class StudentClassController extends Controller
{

    public function viewStudent(){
        $data['allData'] = StudentClass::all();
        return view('backend.setup.student_class.view_class', $data);
    } // EMD METHOD


    public function studentClassAdd(){
        return view('backend.setup.student_class.add_class');
    }// EMD METHOD

    public function studentClassStore(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|unique:student_classes,name',
        ]);
        $data = new StudentClass();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Class added successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.class.view')->with($notification);
    }// EMD METHOD


    public function studentClassEdit($id){
        $editData = StudentClass::findOrFail($id);
        return view('backend.setup.student_class.edit_class', compact('editData'));

    }// EMD METHOD


    public function studentClassUpdate(Request $request, $id){
        $data = StudentClass::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|unique:student_classes,name,'.$data->id,
        ]);
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Class Updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.class.view')->with($notification);
    }// EMD METHOD


    public function studentClassDelete($id){
        $student = StudentClass::findOrFail($id);
        $student->delete();
        $notification = array(
            'message' =>'Student Class Deleted Successfully',
            'alert-type'=> 'info'
        );
        return redirect()->back()->with($notification);
    }// EMD METHOD



}
