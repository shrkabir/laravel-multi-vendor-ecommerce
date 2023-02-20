<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Admin\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::insert([
            'name' => 'Super Admin',
            'type' => 1,
            'vendor_id' => NULL,
            'mobile' => '01025874685',
            'email' => 'admin@superadmin.com',
            'password' => '123456',
            'image' => NULL,
            'status' => 1
        ]);
    }
}
