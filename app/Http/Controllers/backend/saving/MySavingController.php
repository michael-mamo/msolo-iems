<?php

namespace App\Http\Controllers\backend\saving;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MySaving;
use App\Models\SavingType;
use App\Models\MySavingDeposit;
use App\Models\MySavingWithdrawal;
use Auth;
use Carbon\Carbon;
use DB;
class MySavingController extends Controller
{

    // Function to view mySaving
    public function MySavingView(){
        $userId = Auth::user()->id;
        $data['mySavingData'] = MySaving::where('userid', $userId)->orderByRaw("FIELD(status,'In Progress') DESC")->orderBy("status","asc")->get();
        $data['savingTypeData'] = SavingType::where('isactive', 1)->orderby('name')->get();
        $data['mySavingDepositData'] = MySavingDeposit::all();
        $data['mySavingWithdrawalData'] = MySavingWithdrawal::all();
        return view('admin.saving.mySaving', $data);
    }
    public function MySavingAdd(request $request){
        $userId = Auth::user()->id;
        $todayDate = Carbon::today()->format('Y-m-d');

        if($request->targetAmount > $request->amount){
            $data = new MySaving();
            $data->userid = $userId;
            $data->title = $request->title;
            $data->date = $todayDate;
            $data->savingtypeid = $request->savingType;
            $data->savingfor = $request->savingFor;
            $data->amount = $request->amount;
            $data->targetamount = $request->targetAmount;
            $data->status = 'In Progress';
            $data->description = $request->description;
            // Save the data in my saving table
            $data->save();

        $notification = array(
            'message'=>'New Saving is Added successfully',
            'alert-type'=>'success'
        );
        }
        else{
            $notification = array(
                'message'=>'The amount shouldnt be greater than the target amount',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
        return redirect()->route('mySaving.view')->with($notification);
    }
    // Function to edit mysaving
    public function MySavingEdit(request $request, $id){
        $data = MySaving::find($id);
        $data->title = $request->title;
        $data->savingtypeid = $request->savingType;
        $data->savingfor = $request->savingFor;
        $data->targetamount = $request->targetAmount;
        $data->description = $request->description;

        $data->save();
        $notification = array(
            'message'=>'Saving is Updated successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('mySaving.view')->with($notification);
    }
    // Function to delete mysaving
    public function MySavingDelete($id){
        // Get all the deposit data in this saving id
        $depositData = MySavingDeposit::where('savingid', $id)->get(['id']);
        MySavingDeposit::destroy($depositData->toArray());
        $savingData = MySaving::find($id);
        $savingData->delete();

        $notification = array(
            'message'=>'Saving is Deleted Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('mySaving.view')->with($notification);
    }
    // Function to complete my saving
    public function MySavingComplete($id){
        $data = MySaving::find($id);
        if($data->targetamount == $data->amount){
            $data->status = 'Completed';
            $data->save();
            $notification = array(
                'message'=>'Saving is Completed successfully',
                'alert-type'=>'success'
            );
        }
        else{
            $notification = array(
                'message'=>'This Saving Couldnt be completed because it didnt meet the target amount!',
                'alert-type'=>'error'
            );
        }
        return redirect()->route('mySaving.view')->with($notification);
    }
    // Function to terminate my saving
    public function MySavingTerminate($id){
        // Check if meets the required amount
        $data = MySaving::find($id);
        $data->status = 'Terminated';
        $data->save();
        $notification = array(
            'message'=>'Saving is Terminated successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('mySaving.view')->with($notification);
    }
    // reactivate
    public function MySavingReactivate($id){
        // Check if meets the required amount
        $data = MySaving::find($id);
        $data->status = 'In Progress';
        $data->save();
        $notification = array(
            'message'=>'Saving is re activated successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('mySaving.view')->with($notification);
    }

}
