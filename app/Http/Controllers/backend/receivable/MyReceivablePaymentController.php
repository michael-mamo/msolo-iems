<?php

namespace App\Http\Controllers\backend\receivable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MyReceivablePayment;


class MyReceivablePaymentController extends Controller
{
    //
    public function MyReceivablePaymentAdd(Request $request, $lid){
        $data = new MyReceivablePayment();
        $data->receivableid = $lid;
        $data->date = $request->date;
        $data->amount = $request->amount;
        $data->save();
        $notification = array(
            'message'=>'Receivable Payment is added successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('myReceivable.view')->with($notification);
    }
    public function MyReceivablePaymentDelete($id){
        $data = MyReceivablePayment::find($id);
        $data->delete();
        $notification = array(
            'message' => 'Your receivable payment is deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('myReceivable.view')-> with($notification);
    }
}
