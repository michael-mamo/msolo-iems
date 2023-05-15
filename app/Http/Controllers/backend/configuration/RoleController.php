<?php

namespace App\Http\Controllers\backend\configuration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;

class RoleController extends Controller
{
    //function to view all roles registered
    public function RoleView(){
        $data['allData'] = Role::all();
        return view('admin.configuration.role', $data);
    }
    // Function to add role
    public function RoleAdd(Request $request){
        $validatedData = $request->validate([
            'name'=>'required|unique:roles',
        ]);
        $data = new Role();
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
            'message' => 'Role Registered successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('role.view')-> with($notification);
    }
    public function RoleEdit(Request $request, $id){
        $data = Role::find($id);
        $data->description = $request->description;
        if($request->has('isActive')){
            $data->isactive = 1;
        }
        else{
           $data->isactive = 0;
        }
        $data->save();
        $notification = array(
            'message' => 'Role Updated successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('role.view')-> with($notification);
    }
    public function RoleDelete($id){
        // Check if there is registered user with this role before deleting
        $checkData = User::where('roleid', $id)->get();
        if(count($checkData)> 0){
            $notification = array(
                'message' => 'There is a user registered using this role please delete the user before deleting the role OR you can edit and uncheck the isActive field and save it',
                'alert-type' => 'error'
            );
            return redirect()->route('role.view')-> with($notification);
        }
        else{
            $data = Role::find($id);
            $data->delete();
            $notification = array(
                'message' => 'Role Deleted successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('role.view')-> with($notification);
        }
    }
}
