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
            }
        }
        return view('admin.login.login');
    }
    
    public function dashboard(){
        return view('admin.dashboard.dashboard');
    }
}
