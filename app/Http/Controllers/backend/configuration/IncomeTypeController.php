<?php

namespace App\Http\Controllers\backend\configuration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IncomeType;
use App\Models\MyIncome;
class IncomeTypeController extends Controller
{
    //Function to view Income type
    public function IncomeTypeView(){
        $data['allData'] = IncomeType::all();
        return view('admin.configuration.incomeType', $data);
    }
    //Function to add Income Type
    public function IncomeTypeAdd(Request $request){
        $validateData = $request->validate([
            'name'=>'required|unique:income_types',
        ]);
        $data = new IncomeType();
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
            'message'=>'Income Type Registered Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('incomeType.view')->with($notification);
    }
    // Function to edit Income Type
    public function IncomeTypeEdit(Request $request, $id){
        $data = IncomeType::find($id);
        $data->description = $request->description;
        if($request->has('isActive')){
            $data->isactive = 1;
        }
        else{
            $data->isactive = 0;
        }
        $data->save();
        $notification = array(
            'message'=>'Income Type Updated Successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('incomeType.view')->with($notification);
    }
    // Function to delete income type
    public function IncomeTypeDelete($id){
        // Check if there is registred income using this income type
        $checkData = MyIncome::where('incometypeid', $id)->get();
        if(count($checkData) > 0){
            $notification = array(
                "message"=>"There is an income data registered using this income type please remove all the income data registered using this income type before deleting this income type OR you can edit and uncheck the isActive field and save it!",
                "alert-type"=>'error'
            );
            return redirect()->route('incomeType.view')->with($notification);
        }
        else{
            $data = IncomeType::find($id);
            $data->delete();
            $notification = array(
                "message"=>"Income Type Deleted Successfully",
                "alert-type"=>'success'
            );
            return redirect()->route('incomeType.view')->with($notification);
        }
    }
}
