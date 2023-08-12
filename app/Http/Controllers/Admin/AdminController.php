<?php

namespace App\Http\Controllers\Admin;

use Image;
use App\Models\Address\City;
use Illuminate\Http\Request;
use App\Models\Address\State;
use App\Models\Address\Country;
use App\Models\Admin\Admin\Admin;
use App\Models\Admin\Vendor\Vendor;
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
        $rules= [
            // 'name' =>'required | regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'name' =>'required | string',
            'mobile' => 'required | numeric'
        ];

        $this->validate($request, $rules);

        //upload admin photo

        if($request->file('photo')){
            $photo= $request->file('photo');

            if($photo->isValid()){
                $extension= $photo->getClientOriginalExtension();
                $photoName= rand(100, 999).'.'.$extension;
                $photoPath= 'admin/images/photos/'.$photoName;

                Image::make($photo)->save($photoPath);
            }
        }
        
        $admin= Admin::find(Auth::guard('admin')->user()->id);
        // $admin= Admin::where('id', Auth::guard('admin')->user()->id)->update(['name' => $request->name, 'mobile' => $request->mobile]);
        
        // $admin->update([
        //     'name'   => $request->name,
        //     'mobile' => $request->mobile,
        //     'photo'  => $photoName,
        // ]);

        // dd(isset($photoName));

        $admin->name = $request->name;
        $admin->mobile = $request->mobile;
        if(isset($photoName)){
            $admin->photo = $photoName;
        }

        $admin->update();

        return redirect()->back()->with('success_message', 'Admin details updated successfully.');
    }

    public function updateVendorDetails($slug){
        if($slug=="personal"){
            $vendorDetails= Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->first();
            $countries= Country::all();
            $states= State::where('country_id', $vendorDetails->country_id)->get();
            $cities= City::where('state_id', $vendorDetails->state_id)->get();
        }
        else if($slug=="business"){

        }
        else if($slug=="bank"){

        }

        return view('admin.settings.update_vendor_details', compact('slug', 'countries', 'states', 'cities', 'vendorDetails'));
    }

    public function getState(Request $request){
        $countryId= $request->countryId;

        $states= State::where('country_id', $countryId)->get();

        return response($states);
    }

    public function getCity(Request $request){
        $stateId= $request->stateId;

        $cities= City::where('state_id', $stateId)->get();

        return response($cities);
    }
}
