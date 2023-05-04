<?php

namespace App\Http\Controllers\backend\configuration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Usertype;
class UserController extends Controller
{
    // Function to register user from the outside
    public function UserRegister(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|unique:users|string|min:9|max:10|regex:/[0-9]{9}/',
            // 'email'=>'required|unique:users',
            'name'=>'required',
            'gender'=>'required',
            'password' => 'required|confirmed',
        ],
        [
            'email.min' => 'The phone number is invalid',
            'email.max' => 'The phone number is invalid',
            'email.unique' => 'The phone number is already registered'
        ]);
        $data = new User();
        $data->name = $request->name;
        $data->lname = $request->lname;
        $data->role = "User";
        $data->usertype = 2;
        $data->gender = $request->gender;
        $data->phonenumber = $request->phoneNumber;
        if($request->file('image')){
            $file = $request->file('image');
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/userImages/'), $fileName);
            $data['profile_photo_path'] = $fileName;
        }
        $data->isactive = 0;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();
        $notification = array(
            'message' => 'You have registered completely please enter your email and password to login',
            'alert-type' => 'success'
        );

        return redirect()->route('login')->with($notification);
    }

    //Function to view user
    public function UserView(){
        // Alternative to pass data
        // $allData = User::all();
        $data['userData'] = User::all();
        $data['usertypeData'] = Usertype::where('isactive','1')->get();
        return view('admin.configuration.user', $data);
    }

    // Function to add user
    public function UserAdd(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|unique:users|string|min:9|max:10|regex:/[0-9]{9}/',
            // 'email'=>'required|unique:users',
            'name'=>'required',
            'usertype' => 'required',
            'role' => 'required',
            'gender'=>'required',
            'password' => 'required|confirmed'],
            [
                'email.min' => 'The phone number is invalid',
                'email.max' => 'The phone number is invalid',
                'email.unique' => 'The phone number is already registered'
            ]);
        $data = new User();
        $data->name = $request->name;
        $data->lname = $request->lname;
        $data->gender = $request->gender;
        $data->role = $request->role;
        $data->usertype = $request->usertype;
        if($request->has('isActive')){
            $data->isactive = 1;
        }
        else{
           $data->isactive = 0;
        }
        if($request->file('image')){
            $file = $request->file('image');
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/userImages/'), $fileName);
            $data['profile_photo_path'] = $fileName;
        }
        $data->email = $request->email;
        $data->phonenumber = $request->phoneNumber;
        $data->password = bcrypt($request->password);
        $data->save();
        $notification = array(
            'message' => 'User Registered successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('user.view')-> with($notification);
    }

    // Function to edit user
    public function UserEdit(request $request, $id){
        $validatedData = $request->validate([
            'name'=>'required',
            'usertype' => 'required',
            'role' => 'required',
            'gender'=>'required',
        ]);
        $data = User::find($id);
        $data->name = $request->name;
        $data->lname = $request->lname;
        $data->gender = $request->gender;
        $data->role = $request->role;
        $data->usertype = $request->usertype;
        if($request->has('isActive')){
            $data->isactive = 1;
        }
        else{
           $data->isactive = 0;
        }
        if($request->newPassword != NULL){
            $data->password = bcrypt($request->newPassword);
        }
        if($request->file('image')){
            $file = $request->file('image');
            @unlink(public_path('uploads/userImages'.$data->profile_photo_path));
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/userImages/'), $fileName);
            $data['profile_photo_path'] = $fileName;
        }
        $data->save();
        $notification = array(
            'message' => 'User Updated successfully',
            'alert-type' => 'info'
        );


        return redirect()->route('user.view')-> with($notification);
    }
    public function UserDelete($id){
        $data = User::find($id);
        $data->delete();
        $notification = array(
            'message' => 'User Deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('user.view')-> with($notification);
    }

}
