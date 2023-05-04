<?php

namespace App\Http\Controllers\backend\liability;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MyLiabilityPayment;

class MyLiabilityPaymentController extends Controller
{
    //
    public function MyLiabilityPaymentAdd(Request $request, $lid){
        $data = new MyLiabilityPayment();
        $data->liabilityid = $lid;
        $data->date = $request->date;
        $data->amount = $request->amount;
        $data->save();
        $notification = array(
            'message'=>'Liability Payment is added successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('myLiability.view')->with($notification);
    }
    public function MyLiabilityPaymentDelete($id){
        $data = MyLiabilityPayment::find($id);
        $data->delete();
        $notification = array(
            'message' => 'Your liability payment is deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('myLiability.view')-> with($notification);
    }
}
