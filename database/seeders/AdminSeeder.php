<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [
                'name' => 'Admin One',
                'email' => 'admin1@example.com',
                'password' => Hash::make('password123'),
                'phone' => '237600000001',
                'country' => 'Cameroon',
                'balance' => 0,
                'referral_code' => 'ADM10001',
                'is_admin' => true,
            ],
            [
                'name' => 'Admin Two',
                'email' => 'admin2@example.com',
                'password' => Hash::make('password123'),
                'phone' => '237600000002',
                'country' => 'Cameroon',
                'balance' => 0,
                'referral_code' => 'ADM10002',
                'is_admin' => true,
            ],
            [
                'name' => 'Admin Three',
                'email' => 'admin3@example.com',
                'password' => Hash::make('password123'),
                'phone' => '237600000003',
                'country' => 'Cameroon',
                'balance' => 0,
                'referral_code' => 'ADM10003',
                'is_admin' => true,
            ],
        ];

        foreach ($admins as $admin) {
            User::updateOrCreate(
                ['email' => $admin['email']],
                $admin
            );
        }
    }
}
