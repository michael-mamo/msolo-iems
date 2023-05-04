<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\MyIncome;
use App\Models\MyExpense;
use App\Models\MySaving;
use App\Models\ExpenseType;
use App\Models\IncomeType;
use App\Models\SavingType;
use carbon\Carbon;

class MyDashboardController extends Controller
{
    //Function to view my dashboard
    public function MyDashboard(){
        $id = Auth::User()->id;
        // Get date infomration
        $data['myIncomeData'] = MyIncome::where('userid',$id)->get();
        $data['incomeTypeData'] = IncomeType::where('isactive', 1)->get();
        $data['expenseTypeData'] = ExpenseType::where('isactive', 1)->get();
        $data['savingTypeData'] = SavingType::where('isactive', 1)->get();
        $data['todayDate'] = Carbon::today()->format('Y-m-d');
        $data['day'] = Carbon::today()->format('d l');
        $data['month'] = Carbon::today()->format('F');
        $data['year'] = Carbon::today()->format('Y');
        $data['lastYear'] = $data['year'] - 1;
        // Get the total aggregated data information
        $data['thisYearTotalExpense'] = MyExpense::where('userid', $id)
                                        ->whereYear('date', $data['year'])
                                        ->sum('amount');
        $data['lastYearTotalExpense'] = MyExpense::where('userid', $id)
                                        ->whereYear('date', $data['year']-1)
                                        ->sum('amount');
        $data['thisYearTotalIncome'] = MyIncome::where('userid', $id)
                                        ->whereYear('date', $data['year'])
                                        ->sum('amount');
        $data['lastYearTotalIncome'] = MyIncome::where('userid', $id)
                                        ->whereYear('date', $data['year']-1)
                                        ->sum('amount');
        $data['thisYearTotalSaving'] = MySaving::where('userid', $id)
                                        ->whereYear('date', $data['year'])
                                        ->sum('amount');
        $data['thisYearSavingCompleted'] = MySaving::where('userid', $id)
                                            ->where('status','Completed')
                                            ->whereYear('date', $data['year'])
                                            ->count();

        // Get the data for this year increase and last year increase in percent
        $data['thisYearDifference'] = 0.00;
        $data['lastYearDifference'] = 0.00;

        // This Year Increase or Decrease in Percent
        if($data['thisYearTotalIncome'] > $data['thisYearTotalExpense']){
            if($data['thisYearTotalExpense'] == 0){
                $data['thisYearDifference'] = 100;
            }
            else{
                $data['thisYearDifference'] = ($data['thisYearTotalIncome'] - $data['thisYearTotalExpense'])/$data['thisYearTotalExpense'] * 100;
            }
        }
        else{
            if(($data['thisYearTotalIncome'] == $data['thisYearTotalExpense'])){
                $data['thisYearDifference'] = 0;
            }
            elseif(($data['thisYearTotalIncome'] == 0)){
                $data['thisYearDifference'] = -100;
            }
            else{
                $data['thisYearDifference'] = -($data['thisYearTotalExpense'] - $data['thisYearTotalIncome'])/$data['thisYearTotalIncome'] * 100;
            }
        }

        // Last Year Increase or Decrease in percent
        // Income is higher
        if($data['lastYearTotalIncome'] > $data['lastYearTotalExpense']){
            if($data['lastYearTotalExpense'] == 0){
                $data['lastYearDifference'] = 100;
            }
            else{
                $data['lastYearDifference'] = ($data['lastYearTotalIncome'] - $data['lastYearTotalExpense'])/$data['lastYearTotalExpense'] * 100;
            }
        }
        else{
            if(($data['lastYearTotalIncome'] == $data['lastYearTotalExpense'])){
                $data['lastYearDifference'] = 0;
            }
            elseif(($data['lastYearTotalIncome'] == 0)){
                $data['lastYearDifference'] = -100;
            }
            else{
                $data['lastYearDifference'] = -($data['lastYearTotalExpense'] - $data['lastYearTotalIncome'])/$data['lastYearTotalIncome'] * 100;
            }
        }

        // Get the income and expense in each month for this year
        // Get the income for this year in each month
        $data['thisYearIncomeData'] = array();
        for($i=1; $i<=12; $i++){
            $data['thisYearIncomeData'][$i]= MyIncome::where('userid', $id)
                            ->whereYear('date', Carbon::today()->format('Y'))
                            ->whereMonth('date', $i)
                            ->sum('amount');
        }
        // Get the expense of this year in each month
        $data['thisYearExpenseData'] = array();
        for($i=1; $i<=12; $i++){
            $data['thisYearExpenseData'][$i]= MyExpense::where('userid', $id)
                            ->whereYear('date', Carbon::today()->format('Y'))
                            ->whereMonth('date', $i)
                            ->sum('amount');
        }

        // Get the income and expense in each month for last Year
        // Get the income of last year in each month
        $data['lastYearIncomeData'] = array();
        for($i=1; $i<=12; $i++){
            $data['lastYearIncomeData'][$i]= MyIncome::where('userid', $id)
                            ->whereYear('date', Carbon::today()->format('Y')-1)
                            ->whereMonth('date', $i)
                            ->sum('amount');
        }
        // Get the expense of last year in each month
        $data['lastYearExpenseData'] = array();
        for($i=1; $i<=12; $i++){
            $data['lastYearExpenseData'][$i]= MyExpense::where('userid', $id)
                            ->whereYear('date', Carbon::today()->format('Y')-1)
                            ->whereMonth('date', $i)
                            ->sum('amount');
        }
        //Get the income and Expense Infomration for detial info
        $expenseInfo = MyExpense::where('userid',$id)
                        ->whereYear('date', $data['year'])
                        ->groupBy('expensetypeid')
                        ->selectRaw('sum(amount) as sum, expensetypeid')
                        ->orderBy('sum', 'DESC')
                        ->limit(5)
                        ->get('expensetypeid');
        $incomeInfo = MyIncome::where('userid',$id)
                        ->whereYear('date', $data['year'])
                        ->groupBy('incometypeid')
                        ->selectRaw('sum(amount) as sum, incometypeid')
                        ->orderBy('sum', 'DESC')
                        ->limit(5)
                        ->get('incometypeid');

        // Detail info of Income and Expenses
        $data['topFiveIncomeAmounts'] = array();
        $data['topFiveIncomeTypes'] = array();
        $data['topFiveExpenseTypes'] = array();
        $data['topFiveExpenseAmounts'] = array();

        // Get the top five amounts of Income and top Income type
        foreach($incomeInfo as $key=>$income){
            $data['topFiveIncomeAmounts'][$key] = MyIncome::where('userid', $id)
                                            ->where('incometypeid',$income->incometypeid)
                                            ->whereYear('date', $data['year'])
                                            ->sum('amount');
            $data['topFiveIncomeTypes'][$key] = IncomeType::where('id',$income->incometypeid)->value('name');
        }
        // Get the top five amounts of expense and top expense type
        foreach($expenseInfo as $key=>$expense){
            $data['topFiveExpenseAmounts'][$key] = MyExpense::where('userid', $id)
                                            ->where('expensetypeid',$expense->expensetypeid)
                                            ->whereYear('date', $data['year'])
                                            ->sum('amount');
            $data['topFiveExpenseTypes'][$key] = ExpenseType::where('id',$expense->expensetypeid)->value('name');
        }
        return view('admin.index', $data);
    }
}
