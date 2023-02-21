<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login(Request $request){
        if($request->isMethod('post')){
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
}
