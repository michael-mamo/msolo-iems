<?php

namespace App\Http\Controllers\backend\configuration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExpenseType;
use App\Models\MyExpense;

class ExpenseTypeController extends Controller
{
    //Function to view Expense type
    public function ExpenseTypeView(){
        $data['allData'] = ExpenseType::all();
        return view('admin.configuration.expenseType', $data);
    }
    // Function to add Expense Type
    public function ExpenseTypeAdd(Request $request){
        $validateData = $request->validate([
            'name'=>'required|unique:expense_types',
        ]);
        $data = new ExpenseType();
        $data->name = $request->name;
        $data->description = $request->description;
        if($request->has('isActive')){
            $data->isactive = 1;
        }
        else{
            $data->isactive = 0;
        }
        $data->save();
        $notification = array(
            'message' => 'Expense Type Registered successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('expenseType.view')-> with($notification);
    }
    // Function to edit Expense type
    public function ExpenseTypeEdit(Request $request, $id){
        $data = ExpenseType::find($id);
        $data->description = $request->description;
        if($request->has('isActive')){
            $data->isactive = 1;
        }
        else{
            $data->isactive = 0;
        }
        $data->save();
        $notification = array(
            'message' => 'Expense Type Updated Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('expenseType.view')-> with($notification);
    }
    // Function to delete expense type
    public function ExpenseTypeDelete($id){
        $checkData = MyExpense::where('expensetypeid', $id)->get();
        if(count($checkData) > 0){
            $notification = array(
                "message"=>"There is an expense data registered using this expense type please remove all the expense data registered using this expense type before deleting this expense type OR you can edit and uncheck the isActive field and save it!",
                "alert-type"=>'error'
            );
            return redirect()->route('expenseType.view')->with($notification);
        }
        else{
            $data = ExpenseType::find($id);
            $data->delete();
            $notification = array(
                "message"=>"Expense Type Deleted Successfully",
                "alert-type"=>'success'
            );
            return redirect()->route('expenseType.view')->with($notification);
        }
    }
}
