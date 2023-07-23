<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::query()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'type' => Admin::ADMIN_CODE,
            'status' => Admin::ACTIVE_STATUS,
            'password' => Hash::make('123456')
        ]);
    }
}
