<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Vendor\VendorBankDetails;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VendorBankDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorBankDetails= [
            'id' => 1,
            'vendor_id' => 1,
            'account_holder_name' => 'Rajon',
            'bank_id' => 1,
            'branch_name' => 'Dhaka Branch',
            'account_number' => '00000251255224141',
            'routing_number' => '5165165165',
        ];

        VendorBankDetails::insert($vendorBankDetails);
    }
}
