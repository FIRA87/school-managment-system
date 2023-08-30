<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\SchoolSubject;
use Illuminate\Http\Request;

class SchoolSubjectController extends Controller
{

    public function schoolSubjectView(){
        $data['allData'] = SchoolSubject::all();
        return view('backend.setup.school_subject.view_school_subject', $data);
    } // EMD METHOD

    public function schoolSubjectAdd(){
        return view('backend.setup.school_subject.add_school_subject');
    }// EMD METHOD

    public function schoolSubjectStore(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|unique:school_subjects,name',
        ]);
        $data = new SchoolSubject();
        $data->name = $request->name;
        $data->save();
        $notification = array(
            'message' => 'School Subject added successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('school.subject.view')->with($notification);
    }// EMD METHOD

    public function schoolSubjectEdit($id){
        $editData = SchoolSubject::findOrFail($id);
        return view('backend.setup.school_subject.edit_school_subject', compact('editData'));

    }// EMD METHOD

    public function schoolSubjectUpdate(Request $request, $id){
        $data = SchoolSubject::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|unique:school_subjects,name,'.$data->id,
        ]);
        $data->name = $request->name;
        $data->save();
        $notification = array(
            'message' => 'School Subject Updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('school.subject.view')->with($notification);
    }// EMD METHOD

    public function schoolSubjectDelete($id){
        $student = SchoolSubject::findOrFail($id);
        $student->delete();
        $notification = array(
            'message' =>'School Subject Deleted Successfully',
            'alert-type'=> 'info'
        );
        return redirect()->back()->with($notification);
    }// EMD METHOD



}
