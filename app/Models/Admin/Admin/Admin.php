<?php

namespace App\Models\Admin\Admin;

use App\Models\Admin\Vendor\Vendor;
use App\Models\Admin\Vendor\VendorBankDetails;
use App\Models\Admin\Vendor\VendorBusinessDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $guard= 'admin';

    protected $fillable= ['name', 'mobile', 'photo'];

    public function vendor(){
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function vendorBusiness(){
        return $this->belongsTo(VendorBusinessDetails::class, 'vendor_id');
    }

    public function vendorBank(){
        return $this->belongsTo(VendorBankDetails::class, 'vendor_id');
    }
}
