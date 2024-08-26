<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Enums\AccountStatus;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::where('email', 'superadmin@cisams.dev')->first();
        if (!$superAdmin) {
            User::create([
                'name' => 'SuperAdmin',
                'email' => 'superadmin@cisams.dev',
                'username' => 'superadmin',
                'mobile' => 9876543210,
                'password' => Hash::make('admin@123!'),
                'status' => AccountStatus::ACTIVATE,
            ]);
        }
    }
}
