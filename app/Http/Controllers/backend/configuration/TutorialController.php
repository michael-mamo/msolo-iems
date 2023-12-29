<?php

namespace App\Http\Controllers\backend\configuration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tutorial;
use App\Models\TutorialCategory;
use Illuminate\Support\Facades\DB;
class TutorialController extends Controller
{
    //Function to view Tutoriale
    public function TutorialView(){
        $data['allData'] = Tutorial::all();
        $data['tutorialCategory'] = TutorialCategory::all();
        return view('admin.configuration.tutorial', $data);
    }
    //Function to add Income Type
    public function TutorialAdd(Request $request){
        $validateData = $request->validate([
            'title'=>'required|unique:tutorials',
        ]);
        $data = new Tutorial();
        $category = TutorialCategory::find($request->category);
        $data->title = $request->title;
        $data->category = $request->category;
        $data->subtitle = $request->subTitle;
        $data->title = $request->title;
        $data->description = $request->description;
        if($request->file('video')){
            $file = $request->file('video');
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/tutorials/'.$category->name), $fileName);
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
        $category = TutorialCategory::find($request->category);
        $data->category = $request->category;
        $data->title = $request->title;
        $data->subtitle = $request->subTitle;
        $data->description = $request->description;
        if($request->file('file')){
            $file = $request->file('file');
            @unlink(public_path('uploads/tutorials/'.$data->category.'/'.$data->file));
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/tutorials/'.$request->category), $fileName);
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
        $category = TutorialCategory::find($data->category);
        if($data->file){
            @unlink(public_path('uploads/tutorials/'.$category->name.'/'.$data->file));
        }
        $data->delete();
        $notification = array(
            "message"=>"Tutorial Deleted Successfully",
            "alert-type"=>'success'
        );
        return redirect()->route('tutorial.view')->with($notification);
    }

    // Function to view tutorials in help
    public function TutorialHelp(){
         $data['allData'] = Tutorial::where('isactive', 1)
                            ->get();
        // $data['allData'] = Tutorial::all();
        //  $data['tutorialCategory'] = TutorialCategory::all();
        $data['tutorialCategory']  = DB::table('tutorials')
          ->join('tutorial_categories', 'tutorials.category', '=', 'tutorial_categories.id')
          ->select('tutorial_categories.id', 'tutorial_categories.name')
          ->distinct()
          ->get();
         return view('admin.tutorial.help', $data);

    }
}
