<?php

namespace App\Http\Controllers\backend\configuration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tutorial;
class TutorialController extends Controller
{
    //Function to view Tutoriale
    public function TutorialView(){
        $data['allData'] = Tutorial::all();
        return view('admin.configuration.tutorial', $data);
    }
    //Function to add Income Type
    public function TutorialAdd(Request $request){
        $validateData = $request->validate([
            'title'=>'required|unique:tutorials',
        ]);
        $data = new Tutorial();
        $data->title = $request->title;
        $data->subtitle = $request->subTitle;
        $data->title = $request->title;
        $data->description = $request->description;
        if($request->file('video')){
            $file = $request->file('video');
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/tutorials/'), $fileName);
            $data['file'] = $fileName;
        }
        if($request->has('isActive')){
            $data->isactive = 1;
        }
        else{
            $data->isactive = 0;
        }
        $data->save();
        $notification = array(
            'message'=>'Tutorial Added Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('tutorial.view')->with($notification);
    }
    // Function to edit Income Type
    public function TutorialEdit(Request $request, $id){
        $data = Tutorial::find($id);
        $data->title = $request->title;
        $data->subtitle = $request->subTitle;
        $data->description = $request->description;
        if($request->file('file')){
            $file = $request->file('file');
            @unlink(public_path('uploads/tutorials'.$data->file));
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/tutorials/'), $fileName);
            $data['file'] = $fileName;
        }
        if($request->has('isActive')){
            $data->isactive = 1;
        }
        else{
            $data->isactive = 0;
        }
        $data->save();
        $notification = array(
            'message'=>'Tutorial Updated Successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('tutorial.view')->with($notification);
    }
    // Function to delete income type
    public function TutorialDelete($id){
        $data = Tutorial::find($id);
        $data->delete();
        $notification = array(
            "message"=>"Tutorial Deleted Successfully",
            "alert-type"=>'success'
        );
        return redirect()->route('tutorial.view')->with($notification);
    }

    // Function to view tutorials in help
    public function TutorialHelp(){
        $data['allData'] = Tutorial::all();
        return view('admin.tutorial.help', $data);
    }
}
