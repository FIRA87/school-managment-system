<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentGroup;
use Illuminate\Http\Request;

class StudentGroupController extends Controller
{

    public function studentViewGroup(){
        $data['allData'] = StudentGroup::all();
        return view('backend.setup.group.view_group', $data);
    } // EMD METHOD

    public function studentGroupAdd(){
        return view('backend.setup.group.add_group');
    }// EMD METHOD

    public function studentGroupStore(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|unique:student_groups,name',
        ]);
        $data = new StudentGroup();
        $data->name = $request->name;
        $data->save();
        $notification = array(
            'message' => 'Student Group added successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.group.view')->with($notification);
    }// EMD METHOD

    public function studentGroupEdit($id){
        $editData = StudentGroup::findOrFail($id);
        return view('backend.setup.group.edit_group', compact('editData'));

    }// EMD METHOD

    public function studentGroupUpdate(Request $request, $id){
        $data = StudentGroup::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|unique:student_groups,name,'.$data->id,
        ]);
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Group Updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.group.view')->with($notification);
    }// EMD METHOD

    public function studentGroupDelete($id){
        $student = StudentGroup::findOrFail($id);
        $student->delete();
        $notification = array(
            'message' =>'Student Group Deleted Successfully',
            'alert-type'=> 'info'
        );
        return redirect()->back()->with($notification);
    }// EMD METHOD

}
