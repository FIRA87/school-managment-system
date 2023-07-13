<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use Illuminate\Http\Request;

class ExamTypeController extends Controller
{

    public function examTypeView(){
        $data['allData'] = ExamType::all();
        return view('backend.setup.exam_type.view_exam_type', $data);
    } // EMD METHOD

    public function examTypeAdd(){
        return view('backend.setup.exam_type.add_exam_type');
    }// EMD METHOD

    public function examTypeStore(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|unique:exam_types,name',
        ]);
        $data = new ExamType();
        $data->name = $request->name;
        $data->save();
        $notification = array(
            'message' => 'Exam Type added successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('exam.type.view')->with($notification);
    }// EMD METHOD

    public function examTypeEdit($id){
        $editData = ExamType::findOrFail($id);
        return view('backend.setup.exam_type.edit_exam_type', compact('editData'));

    }// EMD METHOD

    public function examTypeUpdate(Request $request, $id){
        $data = ExamType::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|unique:exam_types,name,'.$data->id,
        ]);
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Exam Type Updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('exam.type.view')->with($notification);
    }// EMD METHOD

    public function examTypeDelete($id){
        $student = ExamType::findOrFail($id);
        $student->delete();
        $notification = array(
            'message' =>'Exam Type Deleted Successfully',
            'alert-type'=> 'info'
        );
        return redirect()->back()->with($notification);
    }// EMD METHOD



}
