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
            [
                'name' => 'Super Admin',
                'type' => 1,
                'vendor_id' => NULL,
                'mobile' => '01025874685',
                'email' => 'admin@superadmin.com',
                'password' => '$2y$10$pQtLcLLGXfyC2EgJ8LVwKutpktzpDA/j4lwc10uf6nP4SyvXYP6zy',
                'photo' => NULL,
                'status' => 1
            ],
            [
                'name' => 'Vendor',
                'type' => 4,
                'vendor_id' => 1,
                'mobile' => '01100110011',
                'email' => 'vendor@gmail.com',
                'password' => '$2y$10$pQtLcLLGXfyC2EgJ8LVwKutpktzpDA/j4lwc10uf6nP4SyvXYP6zy',
                'photo' => NULL,
                'status' => 1
            ]
        ]);
    }
}
