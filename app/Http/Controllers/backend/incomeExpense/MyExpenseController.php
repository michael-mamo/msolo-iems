<?php

namespace App\Http\Controllers\backend\incomeExpense;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MyExpense;
use App\Models\ExpenseType;
use App\Models\User;
use Auth;
use Carbon\Carbon;
class MyExpenseController extends Controller
{
    //Function to view My income page
    public function MyExpenseView(){
        $userId = Auth::user()->id;
        $user = User::where('id',$userId)->first();
        $data['fullName'] = $user->name.' '.$user->lname;
        $todayDate = Carbon::today()->format('Y-m-d');
        $todayDay = Carbon::today()->format('d l');
        $todayMonth = Carbon::today()->format('F');
        $todayYear = Carbon::today()->format('Y');
        $lastYear = $todayYear-1;
        $differenceInDay = 0.00;
        $differenceInMonth = 0.00;
        $differenceInYear = 0.00;
        $todayExpense = MyExpense::where('userid', $userId)
                        ->wheredate('date', $todayDate)
                        ->sum('amount');
        $yesterdayExpense = MyExpense::where('userid', $userId)
                            ->wheredate('date', (Carbon::yesterday())
                            ->format('Y-m-d'))
                            ->sum('amount');
        $thisMonthExpense = MyExpense::where('userid', $userId)
                            ->whereYear('date', Carbon::today()
                            ->format('Y'))->whereMonth('date', Carbon::today()
                            ->format('m'))
                            ->sum('amount');
        $lastMonthExpense = MyExpense::where('userid', $userId)
                            ->whereYear('date', Carbon::today()
                            ->format('Y'))
                            ->whereMonth('date', Carbon::today()
                            ->format('m')-1)
                            ->sum('amount');
        $thisYearExpense = MyExpense::where('userid', $userId)
                            ->whereYear('date', Carbon::today()
                            ->format('Y'))
                            ->sum('amount');
        $lastYearExpense = MyExpense::where('userid', $userId)
                            ->whereYear('date', (Carbon::today()
                            ->format('Y'))-1)
                            ->sum('amount');

        // Increase
        if($yesterdayExpense < $todayExpense){
            if($yesterdayExpense==0){
                $differenceInDay = 100;
            }
            else{
                $differenceInDay = ($todayExpense - $yesterdayExpense)/$yesterdayExpense * 100;
            }
        }
        // Decrease or equal
        else{
            if($todayExpense == $yesterdayExpense){
                $differenceInDay = 0;
            }
            elseif($todayExpense==0){
                $differenceInDay = -100;
            }
            else{
                $differenceInDay = -($yesterdayExpense - $todayExpense)/$todayExpense * 100;
            }
        }
        // End of dayly increase check
        // Increase
        if($thisMonthExpense < $lastMonthExpense){
            if($lastMonthExpense==0){
                $differenceInMonth = 100;
            }
            else{
                $differenceInMonth = ($thisMonthExpense - $lastMonthExpense)/$lastMonthExpense * 100;
            }
        }
        // Decrease or equal
        else{
            if($thisMonthExpense == $lastMonthExpense){
                $differenceInMonth = 0;
            }
            elseif($thisMonthExpense==0){
                $differenceInMonth = -100;
            }
            else{
                $differenceInMonth = -($lastMonthExpense - $thisMonthExpense)/$thisMonthExpense * 100;
            }
        }
        // Increase
        if($thisYearExpense < $lastYearExpense){
            if($lastYearExpense==0){
                $differenceInYear = 100;
            }
            else{
                $differenceInMonth = ($thisYearExpense - $lastYearExpense)/$lastYearExpense * 100;
            }
        }
        // Decrease or equal
        else{
            if($thisYearExpense == $lastYearExpense){
                $differenceInYear = 0;
            }
            elseif($thisYearExpense==0){
                $differenceInYear = -100;
            }
            else{
                $differenceInYear = -($lastYearExpense - $thisYearExpense)/$thisYearExpense * 100;
            }
        }
        // End of Yearly increase check
        $data['todayDate'] = $todayDate;
        $data['todayDay'] = $todayDay;
        $data['todayMonth'] = $todayMonth;
        $data['todayYear'] = $todayYear;
        $data['lastYear'] = $lastYear;
        $data['todayExpense'] = $todayExpense;
        $data['differenceInDay'] =  $differenceInDay;
        $data['thisMonthExpense'] = $thisMonthExpense;
        $data['differenceInMonth'] =$differenceInMonth;
        $data['thisYearExpense']= $thisYearExpense;
        $data['differenceInYear'] = $differenceInYear;
        $data['myExpenseData'] = MyExpense::where('userid',$userId)
                                  ->whereYear('date', $todayYear)->orwhereYear('date', $lastYear)->get();
        $data['expenseTypeData'] = ExpenseType::where('isactive', 1)->orderby('name')->get();
        return view('admin.incomeExpense.myExpense', $data);
    }
    // Function to add income
    public function MyExpenseAdd(Request $request){
        $userId = Auth::user()->id;
        $countExpenseType = count($request->expenseType);
        if($countExpenseType != NULL){
            for ($i=0; $i < $countExpenseType; $i++) {
                $data = new MyExpense();
                $data->date = $request->date;
                $data->expensetypeid = $request->expenseType[$i];
                $data->amount = $request->amount[$i];
                $data->description = $request->description[$i];
                $data->userid = $userId;
                $data->save();
            }
        }
        $notification = array(
            'message'=>'New Expense is Added successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('myExpense.view')->with($notification);
    }
    // Function to edit my Income
    public function MyExpenseEdit(request $request, $id){
        $userId = Auth::user()->id;
        $data = MyExpense::find($id);
        $data->date = $request->date;
        $data->amount = $request->amount;
        $data->expensetypeid = $request->expenseType;
        $data->description = $request->description;
        $data->userid = $userId;
        $data->save();
        $notification = array(
            'message'=>'Your Expense is Updated Successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('myExpense.view')->with($notification);
    }
    // Function to delete My income
    public function MyExpenseDelete($id){
        $data = MyExpense::find($id);
        $data->delete();
        $notification = array(
            'message' => 'Your Expense Deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('myExpense.view')-> with($notification);
    }

}
