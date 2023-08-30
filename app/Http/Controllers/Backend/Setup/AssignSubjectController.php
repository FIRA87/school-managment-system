<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\AssignSubjectAmount;
use App\Models\SchoolSubject;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class AssignSubjectController extends Controller
{

    public function viewAssignSubject(){
         // $data['allData'] = AssignSubject::all();
        $data['allData'] = AssignSubject::select('class_id')->groupBy('class_id')->get();
        return view('backend.setup.assign_subject.view_assign_subject', $data);
    }// END METHOD


    public function assignSubjectAdd(){
        $data['subjects'] = SchoolSubject::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.assign_subject.add_assign_subject', $data);
    }// END METHOD


    public function assignSubjectStore(Request $request){
        $subjectCount = count($request->subject_id);
        if($subjectCount !=NULL) {
            for( $i=0; $i < $subjectCount; $i++ ) {
                $assign_subject= new AssignSubject();
                $assign_subject->class_id = $request->class_id;
                $assign_subject->subject_id = $request->subject_id[$i];
                $assign_subject->full_mark = $request->full_mark[$i];
                $assign_subject->pass_mark = $request->pass_mark[$i];
                $assign_subject->subjective_mark = $request->subjective_mark[$i];
                $assign_subject->save();
            }

        } // END if Condition

        $notification = array(
            'message' => 'Assign Subject Inserted successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('assign.subject.view')->with($notification);

    }// END METHOD

    public function assignSubjectEdit($class_id){
        $data['editData'] = AssignSubject::where(['class_id' => $class_id])->orderBy('subject_id', 'asc')->get();
        $data['subjects'] = SchoolSubject::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.assign_subject.edit_assign_subject', $data);
    }   // END METHOD


    public function assignSubjectUpdate(Request $request, $class_id){

        if($request->subject_id == NULL) {
            $notification = array(
                'message' => 'Sorry You do not select any subject',
                'alert-type' => 'error'
            );
            return redirect()->route('assign.subject.edit', $class_id)->with($notification);

        } else {
            $subjectCount = count($request->subject_id);

            AssignSubject::where('class_id',$class_id )->delete();
            for( $i=0; $i < $subjectCount; $i++ ) {
                $assign_subject= new AssignSubject();
                $assign_subject->class_id = $request->class_id;
                $assign_subject->subject_id = $request->subject_id[$i];
                $assign_subject->full_mark = $request->full_mark[$i];
                $assign_subject->pass_mark = $request->pass_mark[$i];
                $assign_subject->subjective_mark = $request->subjective_mark[$i];
                $assign_subject->save();
            }
        }  //END IF ELSE

        $notification = array(
            'message' => 'Data updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('assign.subject.view')->with($notification);

    } // END METHOD

    public function assignSubjectDetail($class_id){
        $data['detailstData'] = AssignSubject::where(['class_id' => $class_id])->orderBy('class_id', 'asc')->get();
        return view('backend.setup.assign_subject.details_assign_subject', $data);

    } // END METHOD

}
