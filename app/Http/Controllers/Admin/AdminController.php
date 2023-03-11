<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
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
}
