<?php

namespace App\Http\Controllers\backend\saving;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MySaving;
use App\Models\MySavingDeposit;
class MySavingDepositController extends Controller
{
    // Function to add mysaving deposit
    public function MySavingDepositAdd(request $request, $id){
        $savingId = $id;
        
        $depositData = new MySavingDeposit();
        $savingData = MySaving::find($id);
        if($request->amount + $savingData->amount <= $savingData->targetamount){
            $depositData->savingid = $savingId;
            $depositData->date = $request->date;
            $depositData->amount = $request->amount;
            $depositData->save();
            $savingData->amount = $savingData->amount + $request->amount;
            $savingData->save();
            
            $notification = array(
                'message'=>'New deposit is made successfully',
                'alert-type'=>'success'
            );
        }
        else{
            $notification = array(
                'message'=>'This deposit will exceed the target amount please extend the target amount or lower the deposit amount to make the deposit',
                'alert-type'=>'error'
            );
        }
        return redirect()->route('mySaving.view')->with($notification);
    }
    public function MySavingDepositDelete($depId){
        $depositData = MySavingDeposit::find($depId);
        $depAmount = $depositData->amount;
        $savingId = $depositData->savingid;
        $savingData = MySaving::find($savingId);
        $savingData->amount = $savingData->amount - $depAmount;
        $savingData->save();

        $depositData = MySavingDeposit::find($depId);
        $depositData->delete();

        $notification = array(
            'message'=>'Deposit is deleted successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('mySaving.view')->with($notification);
    }
}
