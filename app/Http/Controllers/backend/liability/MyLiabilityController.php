<?php

namespace App\Http\Controllers\backend\liability;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MyLiability;
use App\Models\LiabilityType;
use App\Models\MyLiabilityPayment;
use App\Models\User;
use Auth;
use Carbon\Carbon;

class MyLiabilityController extends Controller
{
    // Function to view Liability
    public function MyLiabilityView(){
        $userId = Auth::user()->id;
        $user = User::where('id',$userId)->first();
        $data['fullName'] = $user->name.' '.$user->lname;
        $data['todayDate'] = Carbon::today()->format('Y-m-d');
        $data['payedAmount'] = MyLiability::join('my_liability_payments', 'my_liability_payments.liabilityid','=','my_liabilities.id')->where('userid', $userId)->sum('my_liability_payments.amount');
        $data['totalAmount'] = MyLiability::where('userid', $userId)->sum('amount');
        $data['oweAmount'] = $data['totalAmount'] - $data['payedAmount'];
        $data['myLiabilityData'] = MyLiability::where('userid',$userId)->get();
        $data['liabilityTypeData'] = LiabilityType::where('isactive', 1)->orderby('name')->get();
        $data['myLiabilityPaymentData'] = MyLiabilityPayment::all();
        return view('admin.liability.myLiability', $data);
    }
    // Function to add Liability
    public function MyLiabilityAdd(Request $request){
        $userId = Auth::user()->id;
        $countLiabilityType = count($request->liabilityType);
        if($countLiabilityType != NULL){
            for ($i=0; $i < $countLiabilityType; $i++) {
                $data = new MyLiability();
                $data->date = $request->date;
                $data->lender = $request->lender[$i];
                $data->LiabilityTypeid = $request->liabilityType[$i];
                $data->amount = $request->amount[$i];
                $data->duration = $request->duration[$i];
                $data->description = $request->description[$i];
                $data->userid = $userId;
                $data->save();
            }
        }
        $notification = array(
            'message'=>'New Liability is Added successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('myLiability.view')->with($notification);
    }
    // Function to edit my Liability
    public function MyLiabilityEdit(request $request, $id){
        $userId = Auth::user()->id;
        $data = MyLiability::find($id);
        $data->date = $request->date;
        $data->lender = $request->lender;
        $data->amount = $request->amount;
        $data->duration = $request->duration;
        $data->LiabilityTypeid = $request->liabilityTypeId;
        $data->description = $request->description;
        $data->userid = $userId;
        $data->save();
        $notification = array(
            'message'=>'Your Liability is Updated Successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('myLiability.view')->with($notification);
    }
    // Function to delete My Liability
    public function MyLiabilityDelete($id){
        $data = MyLiability::find($id);
        $data->delete();
        $notification = array(
            'message' => 'Your Liability Deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('myLiability.view')-> with($notification);
    }


}

