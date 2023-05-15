<?php

namespace App\Http\Controllers\backend\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;
class ProfileController extends Controller
{
    public function ViewProfile(request $request){
        $userId = Auth::user()->id;
        $data['profileData'] = User::find($userId);
        return view('admin.profile.myProfile', $data);
    }
    public function EditProfile(request $request){
        $validatedData = $request->validate([
            'name'=>'required',
            'gender'=>'required',
        ]);
        $userId = Auth::user()->id;
        $data = User::find($userId);
        $data->name = $request->name;
        $data->lname = $request->lname;
        $data->gender = $request->gender;
        $data->phonenumber = $request->phoneNumber;
        if($request->file('image')){
            $file = $request->file('image');
            @unlink(public_path('uploads/userImages'.$data->profile_photo_path));
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/userImages/'), $fileName);
            $data['profile_photo_path'] = $fileName;
        }
        $data->save();
        $notification = array(
            'message' => 'Profile is Updated successfully',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }
    public function ChangePassword(request $request, $userId){
        $userData = User::find($userId);
        $oldRealPassword = $userData->password;
        // Check if the entered password of the user is correct
        if(Hash::check($request->oldPassword, $oldRealPassword)){
                if($request->password == $request->password_confirmation){
                    $userData->password = bcrypt($request->password);
                    $userData->save();
                    $notification = array(
                        'message' => 'Your Password is changed successfully',
                        'alert-type' => 'success'
                    );
                    return redirect()->back()->with($notification);

                }
                else{
                    $notification = array(
                        'message' => 'Password confirmation is incorrect',
                        'alert-type' => 'error'
                    );
                    return redirect()->back()->with($notification);
                }
        }
        else{
            $notification = array(
                'message' => 'Your old Password is not correct',
                'alert-type' => 'error'
            );

            return redirect()->back()-> with($notification);
        }

    }
}
