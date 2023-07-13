<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\FreeCategory;
use Illuminate\Http\Request;

class FreeCategoryController extends Controller
{

    public function freeCategoryView(){
        $data['allData'] = FreeCategory::all();
        return view('backend.setup.free_category.view_free_category', $data);
    } // EMD METHOD

    public function freeCategoryAdd(){
        return view('backend.setup.free_category.add_free_category');
    }// EMD METHOD

    public function freeCategoryStore(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|unique:free_categories,name',
        ]);
        $data = new FreeCategory();
        $data->name = $request->name;
        $data->save();
        $notification = array(
            'message' => 'Student Free Category added successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('free.category.view')->with($notification);
    }// EMD METHOD

    public function freeCategoryEdit($id){
        $editData = FreeCategory::findOrFail($id);
        return view('backend.setup.free_category.edit_free_category', compact('editData'));

    }// EMD METHOD

    public function freeCategoryUpdate(Request $request, $id){
        $data = FreeCategory::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|unique:free_categories,name,'.$data->id,
        ]);
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Free Category Updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('free.category.view')->with($notification);
    }// EMD METHOD

    public function freeCategoryDelete($id){
        $student = FreeCategory::findOrFail($id);
        $student->delete();
        $notification = array(
            'message' =>'Student Free Category Deleted Successfully',
            'alert-type'=> 'info'
        );
        return redirect()->back()->with($notification);
    }// EMD METHOD



}
