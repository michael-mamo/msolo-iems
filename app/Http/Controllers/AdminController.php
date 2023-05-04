<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\UserType;
use App\Models\IncomeType;
use App\Models\ExpenseType;
use carbon\Carbon;

class AdminController extends Controller
{
    //Create a function to logout from the system
    public function Logout(){
        Auth::Logout();
        return redirect()->route('login');
    }
    // create a function to view admin dashboard
    public function AdminDashboardView(){
        // Get date informaiton
        $data['todayDate'] = Carbon::today()->format('Y-m-d');
        $data['day'] = Carbon::today()->format('d l');
        $data['month'] = Carbon::today()->format('F');
        $data['year'] = Carbon::today()->format('Y');
        $data['lastYear'] = Carbon::today()->format('Y')-1;
        // Get user info
        $data['userCount'] = User::all()->count();
        $data['activeUserCount'] = User::where('isactive','1')->count();
        $data['inActiveUserCount'] = User::where('isactive','0')->count();
        // Get the user type info
        $data['userTypeCount'] = UserType::all()->count();
        $data['activeUserTypeCount'] = UserType::where('isactive','1')->count();
        $data['inActiveUserTypeCount'] = UserType::where('isactive','0')->count();
        // Get income type info
        $data['incomeTypeCount'] = IncomeType::all()->count();
        $data['activeIncomeTypeCount'] = IncomeType::where('isactive','1')->count();
        $data['inActiveIncomeTypeCount'] = IncomeType::where('isactive','0')->count();
        // Get expense type info
        $data['expenseTypeCount'] = ExpenseType::all()->count();
        $data['activeExpenseTypeCount'] = ExpenseType::where('isactive','1')->count();
        $data['inActiveExpenseTypeCount'] = ExpenseType::where('isactive','0')->count();
        // Get the data for the graph
        $data['thisYearActiveUser'] = User::where('isactive', '1')
                                    ->whereYear('created_at', Carbon::today()
                                    ->format('Y'))
                                    ->count();
        $data['lastYearActiveUser'] = User::where('isactive', '1')
                                    ->whereYear('created_at', Carbon::today()
                                    ->format('Y')-1)
                                    ->count();
        $data['thisYearDifference'] = 0;

        // User registration increase and decrease in percent
        if($data['thisYearActiveUser'] > $data['lastYearActiveUser']){
            if($data['lastYearActiveUser'] == 0){
                $data['thisYearDifference'] = 100;
            }
            else{
                $data['thisYearDifference'] = ($data['thisYearActiveUser'] - $data['lastYearActiveUser'])/$data['lastYearActiveUser'] * 100;
            }
        }
        else{
            if(($data['thisYearActiveUser'] == $data['lastYearActiveUser'])){
                $data['thisYearDifference'] = 0;
            }
            elseif(($data['thisYearActiveUser'] == 0)){
                $data['thisYearDifference'] = -100;
            }
            else{
                $data['thisYearDifference'] = -($data['lastYearActiveUser'] - $data['thisYearActiveUser'])/$data['thisYearActiveUser'] * 100;
            }
        }
        $data['thisYearMonthlyUser'] = array();
        for($i=1; $i<=12; $i++){
            $data['thisYearMonthlyUser'][$i]= User::whereYear('created_at', Carbon::today()->format('Y'))
                            ->whereMonth('created_at', $i)
                            ->count();
        }
        $data['lastYearMonthlyUser'] = array();
        for($i=1; $i<=12; $i++){
            $data['lastYearMonthlyUser'][$i]= User::whereYear('created_at', Carbon::today()->format('Y')-1)
                            ->whereMonth('created_at', $i)
                            ->count();
        }
        // Get the data for pie chart
        $usertypeInfo = User::groupBy('usertype')
                        ->selectRaw('count(usertype) as total, usertype')
                        ->orderBy('total', 'DESC')
                        ->get('usertype');
        $data['topUserTypeCount'] = array();
        $data['topUserTypeName'] = array();
        foreach($usertypeInfo as $key=>$usertype){
            $data['topUserTypeCount'][$key] = User::where('usertype',$usertype->usertype)->count();
            $data['topUserTypeName'][$key] = UserType::where('id',$usertype->usertype)->value('name');
        }
        return view('admin.adminDashboard', $data);
    }
}
