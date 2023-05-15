<?php

namespace App\Http\Controllers\backend\receivable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MyReceivable;
use App\Models\ReceivableType;
use App\Models\MyReceivablePayment;
use App\Models\User;
use Auth;
use Carbon\Carbon;

class MyReceivableController extends Controller
{
    // Function to view Receivable
    public function MyReceivableView(){
        $userId = Auth::user()->id;
        $user = User::where('id',$userId)->first();
        $data['fullName'] = $user->name.' '.$user->lname;
        $data['todayDate'] = Carbon::today()->format('Y-m-d');
        $data['receivedAmount'] = MyReceivable::join('my_receivable_payments', 'my_receivable_payments.receivableid','=','my_receivables.id')->where('userid', $userId)->sum('my_receivable_payments.amount');
        $data['totalAmount'] = MyReceivable::where('userid', $userId)->sum('amount');
        $data['willReceiveAmount'] = $data['totalAmount'] - $data['receivedAmount'];
        $data['myReceivableData'] = MyReceivable::where('userid',$userId)->get();
        $data['receivableTypeData'] = ReceivableType::where('isactive', 1)->orderby('name')->get();
        $data['myReceivablePaymentData'] = MyReceivablePayment::all();
        return view('admin.receivable.myReceivable', $data);
    }
    // Function to add Receivable
    public function MyReceivableAdd(Request $request){
        $userId = Auth::user()->id;
        $countReceivableType = count($request->receivableType);
        if($countReceivableType != NULL){
            for ($i=0; $i < $countReceivableType; $i++) {
                $data = new MyReceivable();
                $data->date = $request->date;
                $data->borrower = $request->borrower[$i];
                $data->receivabletypeid = $request->receivableType[$i];
                $data->amount = $request->amount[$i];
                $data->duration = $request->duration[$i];
                $data->description = $request->description[$i];
                $data->userid = $userId;
                $data->save();
            }
        }
        $notification = array(
            'message'=>'New Receivable is Added successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('myReceivable.view')->with($notification);
    }
    // Function to edit my Receivable
    public function MyReceivableEdit(request $request, $id){
        $userId = Auth::user()->id;
        $data = MyReceivable::find($id);
        $data->date = $request->date;
        $data->borrower = $request->borrower;
        $data->amount = $request->amount;
        $data->duration = $request->duration;
        $data->receivabletypeid = $request->receivableTypeId;
        $data->description = $request->description;
        $data->userid = $userId;
        $data->save();
        $notification = array(
            'message'=>'Your Receivable is Updated Successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('myReceivable.view')->with($notification);
    }
    // Function to delete My Receivable
    public function MyReceivableDelete($id){
        $MyReceivableData = MyReceivable::find($id);
        $MyReceivableData->delete();
        $MyReceivablePaymentData = MyReceivablePayment::Delete('receivableid', $id)->delete();
        $notification = array(
            'message' => 'Your receivable data is deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('myReceivable.view')-> with($notification);
    }


}
