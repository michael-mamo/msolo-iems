<?php

namespace App\Http\Controllers\backend\configuration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TutorialCategory;
use App\Models\Tutorial;
class TutorialCategoryController extends Controller
{
    //Function to view Saving type
    public function TutorialCategoryView(){
        $data['allData'] = TutorialCategory::all();
        return view('admin.configuration.tutorialCategory', $data);
    }
    //Function to add Income Type
    public function TutorialCategoryAdd(Request $request){
        $validateData = $request->validate([
            'name'=>'required|unique:tutorial_categories',
        ]);
        $data = new TutorialCategory();
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
            'message'=>'Tutorial Category is Registered Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('tutorialCategory.view')->with($notification);
    }
    // Function to edit Income Type
    public function TutorialCategoryEdit(Request $request, $id){
        // check if there is registered
        $data = TutorialCategory::find($id);
        $data->description = $request->description;
        if($request->has('isActive')){
            $data->isactive = 1;
        }
        else{
            $data->isactive = 0;
        }
        $data->save();
        $notification = array(
            'message'=>'Tutorial Category is Updated Successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('tutorialCategory.view')->with($notification);
    }
    // Function to delete income type
    public function TutorialCategoryDelete($id){
        // Check if there is saving registered using this saving type
        $checkData = Tutorial::where('category', $id)->get();
        if(count($checkData)>0){
            $notification = array(
                "message"=>"There is tutorial registered using this category please delete the tutorial before deleting this category OR you can edit and uncheck the isActive field and save it",
                "alert-type"=>'error'
            );
            return redirect()->route('tutorialCategory.view')->with($notification);
        }
        else{
            $data = TutorialCategory::find($id);
            $data->delete();
            $notification = array(
                "message"=>"Tutorial Category is Deleted Successfully",
                "alert-type"=>'success'
            );
            return redirect()->route('tutorialCategory.view')->with($notification);
        }

    }
}

