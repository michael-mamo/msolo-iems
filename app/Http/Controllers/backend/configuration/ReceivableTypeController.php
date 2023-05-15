<?php

namespace App\Http\Controllers\backend\configuration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReceivableType;
use App\Models\MyReceivable;

class ReceivableTypeController extends Controller
{
    //Function to view Receivable type
    public function ReceivableTypeView(){
        $data['allData'] = ReceivableType::all();
        return view('admin.configuration.receivableType', $data);
    }
    //Function to add Receivable Type
    public function ReceivableTypeAdd (Request $request){
        $validateData = $request->validate([
            'name'=>'required|unique:receivable_types',
        ]);
        $data = new ReceivableType();
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
            'message'=>'Receivable Type Registered Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('receivableType.view')->with($notification);
    }
    // Function to edit Receivable Type
    public function ReceivableTypeEdit(Request $request, $id){
        $data = ReceivableType::find($id);
        $data->description = $request->description;
        if($request->has('isActive')){
            $data->isactive = 1;
        }
        else{
            $data->isactive = 0;
        }
        $data->save();
        $notification = array(
            'message'=>'Receivable Type Updated Successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('receivableType.view')->with($notification);
    }
    // Function to delete Receivable type
    public function ReceivableTypeDelete($id){
        // Check if there this Receivable is registered under Receivable table
        $checkData = MyReceivable::where('receivableid', $id)->get();
        if(count($checkData)>0){
            $notification = array(
                "message"=>"There is a receivable data registered using this receivable type please delete all the data from the liabilities before deleting this Receivable type OR you can edit and uncheck the isActive field and save it!",
                "alert-type"=>'error'
            );
            return redirect()->route('receivableType.view')->with($notification);
        }
        else{
            $data = ReceivableType::find($id);
            $data->delete();
            $notification = array(
                "message"=>"Receivable Type Deleted Successfully",
                "alert-type"=>'success'
            );
            return redirect()->route('receivableType.view')->with($notification);
        }

    }
}

