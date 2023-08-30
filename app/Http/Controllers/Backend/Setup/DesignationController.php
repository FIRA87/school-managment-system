<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{

    public function designationView(){
        $data['allData'] = Designation::all();
        return view('backend.setup.designation.view_designation', $data);
    } // EMD METHOD

    public function designationAdd(){
        return view('backend.setup.designation.add_designation');
    }// EMD METHOD

    public function designationStore(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|unique:designations,name',
        ]);
        $data = new Designation();
        $data->name = $request->name;
        $data->save();
        $notification = array(
            'message' => 'Designation added successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('designation.view')->with($notification);
    }// EMD METHOD

    public function designationEdit($id){
        $editData = Designation::findOrFail($id);
        return view('backend.setup.designation.edit_designation', compact('editData'));

    }// EMD METHOD

    public function designationUpdate(Request $request, $id){
        $data = Designation::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|unique:designations,name,'.$data->id,
        ]);
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Designation Updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('designation.view')->with($notification);
    }// EMD METHOD

    public function designationDelete($id){
        $student = Designation::findOrFail($id);
        $student->delete();
        $notification = array(
            'message' =>'Designation Deleted Successfully',
            'alert-type'=> 'info'
        );
        return redirect()->back()->with($notification);
    }// EMD METHOD



}
