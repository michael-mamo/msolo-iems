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
            $data['filter'] = 1;
            $data['fromDate'] = $fromDate;
            $data['toDate'] = $toDate;
            $data['report'] = 1;
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
                            // ->whereBetween('date', [$fromDate, $toDate])
                            ->where('status','!=','Terminated')
                            ->groupBy('title', 'savingfor')
                            ->selectRaw('sum(amount) as sum, title, savingfor')
                            ->orderBy('sum', 'DESC')
                            ->get('title','savingfor', 'sum');
            $data['topLiability'] = MyLiability::select('my_liabilities.lender','my_liabilities.amount')->leftJoin('my_liability_payments', 'my_liability_payments.liabilityid','=','my_liabilities.id')->where('userid',$userId)
                            // ->whereBetween('my_liabilities.date', [$fromDate, $toDate])
                            ->groupBy('lender', 'amount')->selectRaw('sum(my_liability_payments.amount) as payed, my_liabilities.amount - sum(COALESCE(my_liability_payments.amount,0)) as unpayed, lender')->get('lender', 'amount', 'payed', 'unpayed');

            $data['topReceivable'] = MyReceivable::select('my_receivables.borrower','my_receivables.amount')->leftJoin('my_receivable_payments', 'my_receivable_payments.receivableid','=','my_receivables.id')->where('userid',$userId)
                            // ->whereBetween('my_liabilities.date', [$fromDate, $toDate])
                            ->groupBy('borrower', 'amount')->selectRaw('sum(my_receivable_payments.amount) as payed, my_receivables.amount - sum(COALESCE(my_receivable_payments.amount,0)) as unpayed, borrower')->get('borrower', 'amount', 'payed', 'unpayed');

            // $data['topReceivable'] = MyReceivable::leftJoin('my_receivable_payments', 'my_receivable_payments.receivableid','=','my_receivables.id')->where('userid', $userId)
            //                 // ->whereBetween('my_receivables.date', [$fromDate, $toDate])
            //                 ->groupBy('borrower')
            //                 ->selectRaw('sum(my_receivables.amount) as total, sum(my_receivable_payments.amount) as payed, sum(my_receivables.amount) - sum(COALESCE(my_receivable_payments.amount,0)) as unpayed, borrower')
            //                 ->orderBy('unpayed', 'DESC')
            //                 ->get('borrower', 'total', 'payed', 'unpayed');
            // dd($data['topReceivable']);
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
