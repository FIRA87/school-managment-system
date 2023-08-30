<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use App\Models\StudentYear;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use PDF;

class StudentRollController extends Controller
{

    public function studentRoleView(){
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        return view('backend.student.roll_generate.roll_generate_view', $data);
    }//  END METHOD

    public function getStudents(Request $request){
        $allData = AssignStudent::with(['student'])->where('year_id', $request->year_id)->where('class_id', $request->class_id)->get();
      //  dd($allData->toArray());
        return response()->json($allData);
    }//  END METHOD

    public function studentRollStore(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;

        if($request->student_id != null){

            for ($i = 0; $i < count($request->student_id); $i++){
                AssignStudent::where('year_id', $year_id)
                              ->where('class_id', $class_id)
                              ->where('student_id', $request->student_id[$i])
                              ->update(['roll' => $request->roll[$i]]);
            } // END FOR loop
        } else {
            $notification = array(
                'message' =>'Sorry there are no data',
                'alert-type'=> 'error',
            );
            return redirect()->back()->with($notification);
        } // END IF Condition

        $notification = array(
            'message' =>'Well done Roll Generated Successfully',
            'alert-type'=> 'success',
        );
        return redirect()->route('role.generate.view')->with($notification);



    }//  END METHOD


}