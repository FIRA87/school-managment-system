<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function profileView(){
        $id = Auth::user()?->id;
        $user = User::findOrFail($id);
        return view('backend.user.view_profile', compact('user'));
    } // END METHOD

    public function profileEdit(){
        $id = Auth::user()?->id;
        $editData = User::findOrFail($id);
        return view('backend.user.edit_profile', compact('editData'));

    }// END METHOD

    public function profileStore(Request $request){
        $data = User::findOrFail(Auth::user()?->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->address = $request->address;
        $data->gender = $request->gender;

        if($request->file('image')) {
           $file = $request->file('image');
           @unlink(public_path('upload/user_images'.$data->image));
           $filename = date('Ymdhi').$file->getClientOriginalName();
           $file->move(public_path('upload/user_images'), $filename);
           $data['image'] = $filename;
        } // END IF

        $data->save();

        $notification = array(
            'message' =>'User Profile Updated successfully',
            'alert-type'=> 'success'
        );

        return redirect()->route('profile.view')->with($notification);
    } // END METHOD


    public function passwordView(){
        return view('backend.user.edit_password');
    }// END METHOD

    public function passwordUpdate(Request $request){
        $validatedData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        $hashedPassword = Auth::user()->password;
         if(Hash::check($request->oldpassword, $hashedPassword)) {
             $user = User::find(Auth::id());
             $user->password = Hash::make($request->password);
             $user->save();
             Auth::logout();
             return redirect()->route('login');
         } else {
             return redirect()->back();
         }






    }// END METHOD

}
