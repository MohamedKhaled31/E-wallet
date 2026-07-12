<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. إنشاء حساب الآدمن (Admin)
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@wallet.com',
            'phone' => '01000000000',
            'password' => Hash::make('123456'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        $user1 = User::create([
            'name' => 'Amr Khaled',
            'email' => 'amr@wallet.com',
            'phone' => '01111111111',
            'password' => Hash::make('123456'),
            'role' => 'user',
            'status' => 'active',
        ]);
        Wallet::create([
            'user_id' => $user1->id,
            'balance' => 500.00,
            'currency' => 'EGP',
            'status' => 'active',
        ]);

        $user2 = User::create([
            'name' => 'Mohamed Khaled',
            'email' => 'mohamed@wallet.com',
            'phone' => '01000101010',
            'password' => Hash::make('123456'),
            'role' => 'user',
            'status' => 'active',
        ]);
        Wallet::create([
            'user_id' => $user2->id,
            'balance' => 1000.00,
            'currency' => 'EGP',
            'status' => 'active',
        ]);
    }
}
