<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Vendor\VendorBusinessDetails;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VendorBusinessDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorBusinessDetails= [
            'id' => 1,
            'vendor_id' => 1,
            'shop_name' => 'Abc Shop',
            'shop_address' => '1/3, Dhaka-0025',
            'shop_country_id' => 1,
            'shop_state_id' => 1,
            'shop_city_id' => 1,
            'shop_pincode' => '1151165',
            'shop_phone' => '02056516515',
            'shop_website' => 'www.shopsite.com',
            'shop_email' => 'abcshop@mail.com',
            'shop_licence_number' => '1515165165'

        ];

        VendorBusinessDetails::insert($vendorBusinessDetails);
    }
}
