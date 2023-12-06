<?php

namespace App\Http\Controllers\Admin;

use Image;
use App\Models\Address\City;
use Illuminate\Http\Request;
use App\Models\Address\State;
use App\Models\Address\Country;
use App\Models\Admin\Admin\Admin;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Vendor\Vendor;
use App\Http\Controllers\Controller;
use App\Models\Admin\Vendor\VendorBusinessDetails;
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

    public function updateVendorDetails($slug, Request $request){
        if($slug=="personal"){

            $vendorDetails= Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->first();

            if($request->isMethod('post')){
                $rules=[
                    'name' => 'required|string',
                    'mobile' => 'required',
                    // 'photo' => 'required',
                    'country_id' => 'required',
                    'state_id' => 'required',
                    'city_id' => 'required',
                    'post_code' => 'required|string',
                    'address' => 'required'
                ];
    
                $errorMessages=[
                    'country_id.required' => 'Country is required.',
                    'state_id.required' => 'State is required.',
                    'city_id.required' => 'City is required.'
                ];
    
                $this->validate($request, $rules, $errorMessages);

                $admin= Admin::where('id', Auth::guard('admin')->user()->id)->first();

                DB::beginTransaction();

                try{
                    $admin->name = $request->name;
                    $admin->mobile = $request->mobile;

                    if($request->file('photo')){
                        $photo= $request->file('photo');
            
                        if($photo->isValid()){
                            $extension= $photo->getClientOriginalExtension();
                            $photoName= rand(100, 999).'.'.$extension;
                            $photoPath= 'admin/images/photos/'.$photoName;
            
                            Image::make($photo)->save($photoPath);
                        }
                    }

                    if(isset($photoName)){
                        $admin->photo = $photoName;
                    }

                    $admin->save();

                    $vendorDetails->country_id = $request->country_id;
                    $vendorDetails->state_id = $request->state_id;
                    $vendorDetails->city_id = $request->city_id;
                    $vendorDetails->post_code = $request->post_code;
                    $vendorDetails->address = $request->address;

                    $vendorDetails->save();

                    DB::commit();

                    return redirect()->back()->with('success_message', 'Vendor details updated successfully.');
                }catch(\Exception $e){
                    DB::rollback();
                }
            }
        }
        else if($slug=="business"){
            $vendorDetails= VendorBusinessDetails::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first();
            if($request->isMethod == 'post'){
                $rules = [
                    'shop_name' => 'required|string',
                    'shop_phone' => 'required|numeric',
                    'shop_website' => 'required',
                    'country_id' => 'required',
                    'state_id' => 'required',
                    'city_id' => 'required',
                    'shop_pincode' => 'required|numeric',
                    'shop_address' => 'required',
                    'shop_licence_number' => 'required|string',
                ];

                $errorMessages= [
                    'shop_name.required' => 'Shop Name is required',
                    'shop_phone.required' => 'Shop phone number is required',
                    'shop_phone.numeric' => 'Shop phone number should be numeric',
                    'shop_website.required' => 'Shop website is required',
                    'country_id.required' => 'Shop country is required',
                    'state_id.required' => 'Shop state is required',
                    'city_id.required' => 'Shop city is required',
                    'shop_pincode.required' => 'Shop pincode is required',
                    'shop_address.required' => 'Shop address is required',
                    'shop_licence_number.required' => 'Shop licence number is reqeuired'
                ];

                $this->validate($request, $rules, $errorMessages);

                $vendorDetails->shop_name = $request->shop_name;
                $vendorDetails->shop_phone = $request->shop_phone;
                $vendorDetails->shop_website = $request->shop_website;
                $vendorDetails->country_id = $request->country_id;
                $vendorDetails->state_id = $request->state_id;
                $vendorDetails->city_id = $request->city_id;
                $vendorDetails->shop_pincode = $request->shop_pincode;
                $vendorDetails->shop_address = $request->shop_address;
                $vendorDetails->shop_licence_number = $request->shop_licence_number;

                $vendorDetails->update();
            }
        }
        else if($slug=="bank"){

        }

        $countries= Country::all();
        $states= State::where('country_id', $vendorDetails->country_id)->get();
        $cities= City::where('state_id', $vendorDetails->state_id)->get();

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
