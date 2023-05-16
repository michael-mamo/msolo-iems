<?php

namespace App\Http\Controllers\backend\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MyIncome;
use App\Models\MyExpense;
use App\Models\MySaving;
use App\Models\MyLiability;
use App\Models\MyReceivable;
use Auth;
use carbon\Carbon;
class ReportController extends Controller
{
    //function to view report
    public function ReportView(){
        $data['report'] = 0;
        return view('admin.report.reportView', $data);
    }
    public function ReportGenerate(Request $request){
        $userId = Auth::user()->id;
        $fromDate = $request->fromDate;
        $toDate = $request->toDate;
        if($fromDate <= $toDate){
            $data['report'] = 1;
            $data['fromDate'] = $fromDate;
            $data['toDate'] = $toDate;
            $data['reportDate'] = Carbon::now()->format('Y-m-d H:i:s');
            $data['totalIncome'] = MyIncome::where('userid', $userId)->whereBetween('date', [$fromDate, $toDate])->sum('amount');
            $data['totalExpense'] = MyExpense::where('userid', $userId)->whereBetween('date', [$fromDate, $toDate])->sum('amount');
            $data['netIncome'] = $data['totalIncome'] - $data['totalExpense'];
            $data['totalSaving'] = MySaving::where('userid', $userId)->whereBetween('date', [$fromDate, $toDate])->sum('amount');
            $data['totalLiability'] = MyLiability::where('userid', $userId)->whereBetween('date', [$fromDate, $toDate])->sum('amount');
            $data['totalReceivable'] = MyReceivable::where('userid', $userId)->whereBetween('date', [$fromDate, $toDate])->sum('amount');
            $data['topExpense'] = MyExpense::where('userid',$userId)
                            ->whereBetween('date', [$fromDate, $toDate])
                            ->groupBy('expensetypeid')
                            ->selectRaw('sum(amount) as sum, expensetypeid')
                            ->orderBy('sum', 'DESC')
                            ->get('expensetypeid', 'sum');
            $data['topIncome'] = MyIncome::where('userid',$userId)
                            ->whereBetween('date', [$fromDate, $toDate])
                            ->groupBy('incometypeid')
                            ->selectRaw('sum(amount) as sum, incometypeid')
                            ->orderBy('sum', 'DESC')
                            ->get('incometypeid', 'sum');
            $data['topSaving'] = MySaving::where('userid',$userId)
                            ->whereBetween('date', [$fromDate, $toDate])
                            ->groupBy('savingtypeid')
                            ->selectRaw('sum(amount) as sum, savingtypeid')
                            ->orderBy('sum', 'DESC')
                            ->get('savingtypeid', 'sum');
            $data['topLiability'] = MyLiability::leftJoin('my_liability_payments', 'my_liability_payments.liabilityid','=','my_liabilities.id')->where('userid',$userId)
                            ->whereBetween('my_liability_payments.date', [$fromDate, $toDate])
                            ->groupBy('lender')
                            ->selectRaw('sum(my_liabilities.amount) as total, sum(my_liability_payments.amount) as payed, sum(my_liabilities.amount)-sum(my_liability_payments.amount) as unpayed, lender')
                            ->orderBy('unpayed', 'DESC')
                            ->get('lender', 'total', 'payed', 'unpayed');

            $data['topReceivable'] = MyReceivable::leftJoin('my_receivable_payments', 'my_receivable_payments.receivableid','=','my_receivables.id')->where('userid', $userId)
                            ->whereBetween('my_receivable_payments.date', [$fromDate, $toDate])
                            ->groupBy('borrower')
                            ->selectRaw('sum(my_receivables.amount) as total, sum(my_receivable_payments.amount) as payed, sum(my_receivables.amount)-sum(my_receivable_payments.amount) as unpayed, borrower')
                            ->orderBy('unpayed', 'DESC')
                            ->get('borrower', 'total', 'payed', 'unpayed');
            // dd($data['topIncome']);
            return view('admin.report.reportView', $data);
        }
        else{
            $data['report'] = 0;
            $notification = array(
                'message' => 'From date should be atleast less than or equal to to date',
                'alert-type' => 'error'
            );
            return redirect()->route('report.view')-> with($notification);
        }


    }
}
