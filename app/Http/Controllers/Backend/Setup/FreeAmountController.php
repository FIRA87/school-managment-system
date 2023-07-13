<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\FreeCategory;
use App\Models\FreeCategoryAmount;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class FreeAmountController extends Controller
{

    public function viewFreeAmount(){
      //  $data['allData'] = FreeCategoryAmount::all();
        $data['allData'] = FreeCategoryAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
        return view('backend.setup.free_amount.view_free_amount', $data);
    }// END METHOD


    public function freeAmountAdd(){
        $data['fee_categories'] = FreeCategory::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.free_amount.add_free_amount', $data);
    }// END METHOD


    public function feeAmountStore(Request $request){
        $countClass = count($request->class_id);

        if($countClass !=NULL) {
            for( $i=0; $i < $countClass; $i++ ) {
                $fee_amount = new FreeCategoryAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();
            }

        } // END if Condition

        $notification = array(
            'message' => 'Fee Amount Inserted successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('fee.amount.view')->with($notification);

    }// END METHOD


    public function feeAmountEdit($fee_category_id){
        $data['editData'] = FreeCategoryAmount::where(['fee_category_id' => $fee_category_id])->orderBy('class_id', 'asc')->get();
        $data['fee_categories'] = FreeCategory::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.free_amount.edit_free_amount', $data);


    }   // END METHOD


    public function feeAmountUpdate(Request $request, $fee_category_id){

        if($request->class_id == NULL) {
            $notification = array(
                'message' => 'Sorry You do not select any item class amount',
                'alert-type' => 'error'
            );
            return redirect()->route('fee.amount.edit', $fee_category_id)->with($notification);

        } else {
            $countClass = count($request->class_id);

            FreeCategoryAmount::where('fee_category_id',$fee_category_id )->delete();
                for( $i=0; $i < $countClass; $i++ ) {
                    $fee_amount = new FreeCategoryAmount();
                    $fee_amount->fee_category_id = $request->fee_category_id;
                    $fee_amount->class_id = $request->class_id[$i];
                    $fee_amount->amount = $request->amount[$i];
                    $fee_amount->save();
                }
        }  //END IF ELSE

        $notification = array(
            'message' => 'Data updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('fee.amount.view')->with($notification);

    } // END METHOD

    public function feeAmountDetail($fee_category_id){
        $data['detailstData'] = FreeCategoryAmount::where(['fee_category_id' => $fee_category_id])->orderBy('class_id', 'asc')->get();

        return view('backend.setup.free_amount.details_fee_amount', $data);

    } // END METHOD

}
