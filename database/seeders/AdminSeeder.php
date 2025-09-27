<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'name' => 'Musa Saheed',
            'email' => 'admin@saheed.com',
            'password' => Hash::make('Admin12345'),
            'actual_password' => 'Admin12345',
        ]);
    }
}