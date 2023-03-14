<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Admin\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login(Request $request){
        if($request->isMethod('post')){
            
            $rules=[
                'email'=>'required|email|max:255',
                'password'=>'required',
            ];

            $errorMessages= [
                'email.required'=>'Email is required',
                'email.email'=>'Valid email is required',
                'password.required'=>'Password is required',
            ];

            $this->validate($request,$rules,$errorMessages);

            if(Auth::guard('admin')->attempt(['email'=>$request->email, 'password'=>$request->password, 'status'=>1])){
                return redirect('admin/dashboard');
            }else{
                return redirect('admin/login')->with('error_message', "Invalid username or password.");
            }
        }
        return view('admin.login.login');
    }

    public function logout(){
        Auth::guard('admin')->logout();

        return redirect('admin/login');
    }
    
    public function dashboard(){
        return view('admin.dashboard.dashboard');
    }

    public function editAdminPassword(){
        $adminDetails= Auth::guard('admin')->user();
        // dd($adminDetails);
        return view('admin.settings.edit_admin_password', compact('adminDetails'));
    }

    public function checkAdminPassword(Request $request){
        if(Hash::check($request->currentPassword, Auth::guard('admin')->user()->password)){
            return "true";
        }else{
            return "false";
        }
    }

    public function updateAdminPassword(Request $request){
        if(Hash::check($request->current_password, Auth::guard('admin')->user()->password)){
            if($request->new_password == $request->confirm_password){
                Admin::where('id', Auth::guard('admin')->user()->id)->update([
                    'password' => bcrypt($request->new_password)
                ]);
                return redirect()->back()->with('success_message', 'Password updated successfully.');
            }else{
                return redirect()->back()->with('error_message', 'Confirm password does not match');
            }
        }else{
            return redirect()->back()->with('error_message', 'Current password does not match');
        }
    }

    public function editAdminDetails(){
        return view('admin.settings.edit_admin_details');
    }

    public function updateAdminDetails(Request $request){
        $admin= Admin::find(Auth::guard('admin')->user()->id);
        // $admin= Admin::where('id', Auth::guard('admin')->user()->id)->update(['name' => $request->name, 'mobile' => $request->mobile]);
        
        $admin->update([
            'name' => $request->name,
            'mobile' => $request->mobile,
        ]);

        return redirect()->back()->with('success_message', 'Admin details updated successfully.');
    }
}
