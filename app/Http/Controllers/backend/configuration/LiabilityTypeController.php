<?php

namespace App\Http\Controllers\backend\configuration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LiabilityType;
use App\Models\MyLiability;

class LiabilityTypeController extends Controller
{
     //Function to view Liability type
     public function LiabilityTypeView(){
        $data['allData'] = LiabilityType::all();
        return view('admin.configuration.liabilityType', $data);
    }
    //Function to add Liability Type
    public function LiabilityTypeAdd (Request $request){
        $validateData = $request->validate([
            'name'=>'required|unique:liability_types',
        ]);
        $data = new LiabilityType();
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
            'message'=>'Liability Type Registered Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('liabilityType.view')->with($notification);
    }
    // Function to edit Liability Type
    public function LiabilityTypeEdit(Request $request, $id){
        $data = LiabilityType::find($id);
        $data->description = $request->description;
        if($request->has('isActive')){
            $data->isactive = 1;
        }
        else{
            $data->isactive = 0;
        }
        $data->save();
        $notification = array(
            'message'=>'Liability Type Updated Successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('liabilityType.view')->with($notification);
    }
    // Function to delete Liability type
    public function LiabilityTypeDelete($id){
        // Check if there this liability is registered under liability table
        $checkData = MyLiability::where('liabilityid', $id)->get();
        if(count($checkData)>0){
            $notification = array(
                "message"=>"There is a liability data registered using this liability type please delete all the data from the liabilities before deleting this liability type OR you can edit and uncheck the isActive field and save it!",
                "alert-type"=>'error'
            );
            return redirect()->route('liabilityType.view')->with($notification);
        }
        else{
            $data = LiabilityType::find($id);
            $data->delete();
            $notification = array(
                "message"=>"Liability Type Deleted Successfully",
                "alert-type"=>'success'
            );
            return redirect()->route('liabilityType.view')->with($notification);
        }

    }
}
