<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function userView(){
       $allData = User::all();
       return view('backend.user.view_user', compact('allData'));
    }// END METHOD

    public function userAdd(){
        return view('backend.user.add_user');
    } // END METHOD

    public function userStore(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|unique:users',
            'name' => 'required',
        ]);

        $data = new User();
        $data->usertype = $request->usertype;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();

        $notification = array(
            'message' => 'User added successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('user.view')->with($notification);
    } // END METHOD


    public function userEdit($id){
        $editData = User::findOrFail($id);
        return view('backend.user.edit_user', compact('editData'));
    }// END METHOD


    public function userUpdate(Request $request, $id){
        $data = User::findOrFail($id);
        $data->usertype = $request->usertype;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->save();

        $notification = array(
            'message' => 'User updated successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('user.view')->with($notification);
    }// END METHOD


    public function userDelete($id){
        $user = User::findOrFail($id);
        $user->delete();
        $notification = array(
            'message' =>'User deleted successfully',
            'alert-type'=> 'info'
        );
        return redirect()->back()->with($notification);
    } // END METHOD








}
