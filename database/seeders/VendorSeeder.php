<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Vendor\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendor= [
            'id' => 1,
            'name' => 'Rahim',
            'country_id' => 1,
            'state_id' => 1,
            'city_id' => 1,
            'address' => 'Dhaka-001',
            'post_code' => '00011',
            'phone' => '01100110011',
            'email' => 'vendor@gmail.com',
            'status' => 0
        ];

        Vendor::insert($vendor);
    }
}
