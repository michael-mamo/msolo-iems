<?php

namespace App\Http\Controllers\backend\configuration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SavingType;
use App\Models\MySaving;
class SavingTypeController extends Controller
{
    //Function to view Saving type
    public function SavingTypeView(){
        $data['allData'] = SavingType::all();
        return view('admin.configuration.savingType', $data);
    }
    //Function to add Income Type
    public function SavingTypeAdd(Request $request){
        $validateData = $request->validate([
            'name'=>'required|unique:saving_types',
        ]);
        $data = new SavingType();
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
            'message'=>'Saving Type Registered Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('savingType.view')->with($notification);
    }
    // Function to edit Income Type
    public function SavingTypeEdit(Request $request, $id){
        // check if there is registered
        $data = SavingType::find($id);
        $data->description = $request->description;
        if($request->has('isActive')){
            $data->isactive = 1;
        }
        else{
            $data->isactive = 0;
        }
        $data->save();
        $notification = array(
            'message'=>'Saving Type Updated Successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('savingType.view')->with($notification);
    }
    // Function to delete income type
    public function SavingTypeDelete($id){
        // Check if there is saving registered using this saving type
        $checkData = MySaving::where('savingtypeid', $id)->get();
        if(count($checkData)>0){
            $notification = array(
                "message"=>"There is saving data registered using this saving type please delete the saving before deleting this saving type OR you can edit and uncheck the isActive field and save it",
                "alert-type"=>'error'
            );
            return redirect()->route('savingType.view')->with($notification);
        }
        else{
            $data = SavingType::find($id);
            $data->delete();
            $notification = array(
                "message"=>"Saving Type Deleted Successfully",
                "alert-type"=>'success'
            );
            return redirect()->route('savingType.view')->with($notification);
        }

    }
}
