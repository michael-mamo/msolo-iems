<?php

namespace App\Http\Controllers\backend\incomeExpense;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MyIncome;
use App\Models\IncomeType;
use App\Models\User;
use Auth;
use Carbon\Carbon;
class MyIncomeController extends Controller
{
    //Function to view My income page
    public function MyIncomeView(){
        $userId = Auth::user()->id;
        $user = User::where('id',$userId)->first();
        $data['fullName'] = $user->name.' '.$user->lname;
        $todayDate = Carbon::today()->format('Y-m-d');
        $todayDay = Carbon::today()->format('d l');
        $todayMonth = Carbon::today()->format('F');
        $todayYear = Carbon::today()->format('Y');
        $differenceInDay = 0.00;
        $differenceInMonth = 0.00;
        $differenceInYear = 0.00;
        $todayIncome = MyIncome::where('userid', $userId)->wheredate('date', $todayDate)->sum('amount');
        $yesterdayIncome = MyIncome::where('userid', $userId)->wheredate('date', (Carbon::yesterday())->format('Y-m-d'))->sum('amount');
        $thisMonthIncome = MyIncome::where('userid', $userId)->whereYear('date', Carbon::today()->format('Y'))->whereMonth('date', Carbon::today()->format('m'))->sum('amount');
        $lastMonthIncome = MyIncome::where('userid', $userId)->whereYear('date', Carbon::today()->format('Y'))->whereMonth('date', Carbon::today()->format('m')-1)->sum('amount');
        $thisYearIncome = MyIncome::where('userid', $userId)->whereYear('date', Carbon::today()->format('Y'))->sum('amount');
        $lastYearIncome = MyIncome::where('userid', $userId)->whereYear('date', (Carbon::today()->format('Y'))-1)->sum('amount');

        if($yesterdayIncome == $todayIncome){
            $differenceInDay = 0;
        }
        elseif($yesterdayIncome > 0 && $todayIncome > 0){
            $differenceInDay = ($todayIncome - $yesterdayIncome)/$yesterdayIncome * 100;
        }
        else{
            if($yesterdayIncome==0 && $todayIncome!=0){
                $differenceInDay = 100;
            }
            elseif($todayIncome == 0 && $yesterdayIncome != 0 ){
                $differenceInDay = -100;
            }
        }
        // End of dayly increase check
        if($lastMonthIncome == $thisMonthIncome){
            $differenceInMonth = 0;
        }
        elseif($lastMonthIncome > 0 && $thisMonthIncome > 0){
            $differenceInMonth = ($thisMonthIncome - $lastMonthIncome)/$lastMonthIncome * 100;
        }
        else{
            if($lastMonthIncome==0 && $thisMonthIncome!=0){
                $differenceInMonth = 100;
            }
            elseif($thisMonthIncome == 0 && $lastMonthIncome != 0 ){
                $differenceInMonth = -100;
            }
        }
        // End of monthly increase check
        if($lastYearIncome == $thisYearIncome){
            $differenceInYear = 0;
        }
        elseif($lastYearIncome > 0 && $thisYearIncome > 0){
            $differenceInYear = ($thisYearIncome - $lastYearIncome)/$lastYearIncome * 100;
        }
        else{
            if($lastYearIncome==0 && $thisYearIncome!=0){
                $differenceInYear = 100;
            }
            elseif($thisYearIncome == 0 && $lastYearIncome != 0 ){
                $differenceInYear = -100;
            }
        }
        // dd($differenceInYear);
        // End of Yearly increase check
        $data['todayDate'] = $todayDate;
        $data['todayDay'] = $todayDay;
        $data['todayMonth'] = $todayMonth;
        $data['todayYear'] = $todayYear;
        $data['todayIncome'] = $todayIncome;
        $data['differenceInDay'] =  $differenceInDay;
        $data['thisMonthIncome'] = $thisMonthIncome;
        $data['differenceInMonth'] =$differenceInMonth;
        $data['thisYearIncome']= $thisYearIncome;
        $data['differenceInYear'] = $differenceInYear;
        $data['myIncomeData'] = MyIncome::where('userid',$userId)->get();
        $data['incomeTypeData'] = IncomeType::where('isactive', 1)->orderby('name')->get();
        return view('admin.incomeExpense.myIncome', $data);
    }
    // Function to add income
    public function MyIncomeAdd(Request $request){
        $userId = Auth::user()->id;
        $countIncomeType = count($request->incomeType);
        if($countIncomeType != NULL){
            for ($i=0; $i < $countIncomeType; $i++) {
                $data = new MyIncome();
                $data->date = $request->date[$i];
                $data->incometypeid = $request->incomeType[$i];
                $data->amount = $request->amount[$i];
                $data->description = $request->description[$i];
                $data->userid = $userId;
                $data->save();
            }
        }
        $notification = array(
            'message'=>'New Income is Added successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('myIncome.view')->with($notification);
    }
    // Function to edit my Income
    public function MyIncomeEdit(request $request, $id){
        $userId = Auth::user()->id;
        $data = MyIncome::find($id);
        $data->date = $request->date;
        $data->amount = $request->amount;
        $data->incometypeid = $request->incomeType;
        $data->description = $request->description;
        $data->userid = $userId;
        $data->save();
        $notification = array(
            'message'=>'Your Income is Updated Successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('myIncome.view')->with($notification);
    }
    // Function to delete My income
    public function MyIncomeDelete($id){
        $data = MyIncome::find($id);
        $data->delete();
        $notification = array(
            'message' => 'Your Income Deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('myIncome.view')-> with($notification);
    }


}
