<?php

namespace App\Http\Controllers\backend\saving;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MySaving;
use App\Models\MySavingWithdrawal;
class MySavingWithdrawalController extends Controller
{
    //// Function to add mysaving withdrawal
    public function MySavingWithdrawalAdd(request $request, $id){
        $savingData = MySaving::find($id);
        if($request->amount < $savingData->amount ){
            $savingData->amount = $savingData->amount - $request->amount;
            $savingData->save();
            $withdrawalData = new MySavingWithdrawal();
            $withdrawalData->savingid = $id;
            $withdrawalData->date = $request->date;
            $withdrawalData->amount = $request->amount;
            $withdrawalData->save();
            $notification = array(
                'message'=>'New withdrawal is made successfully',
                'alert-type'=>'success'
            );
        }
        else{
            $notification = array(
                'message'=>'Withdrawal amount is greater than the amount in saving',
                'alert-type'=>'error'
            );
        }
        
        return redirect()->route('mySaving.view')->with($notification);
    }
    // Function to delete withdrawal
    public function MySavingWithdrawalDelete($witId){
        $withdrawalData = MySavingWithdrawal::find($witId);
        $depAmount = $withdrawalData->amount;
        $savingId = $withdrawalData->savingid;
        $savingData = MySaving::find($savingId);
        $savingData->amount = $savingData->amount + $depAmount;
        $savingData->save();
        $withdrawalData = MySavingWithdrawal::find($witId);
        $withdrawalData->delete();
        $notification = array(
            'message'=>'Withdrawal is deleted successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('mySaving.view')->with($notification);
    }
}
