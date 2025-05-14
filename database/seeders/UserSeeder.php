<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define users
        $users = [
            [
                'first_name' => 'superadmin',
                'email' => 'superadmin@example.com',
                'password' => 'chameleon@2025',
                'role' => 'Admin',
                'gender' => 'Male',
                'phone_number' => '+91 1234567891',
                'address'      => '101 Galaxy Residency, MG Road',
                'city'         => 'Mumbai',
                'state'        => 'Maharashtra',
                'pincode'      => '400001',
            ],
            [
                'first_name' => 'manager',
                'email' => 'manager@example.com',
                'password' => 'manager@2025',
                'role' => 'Manager',
                'gender' => 'Male',
                'phone_number' => '+91 1234567891',
                'address'      => '101 Galaxy Residency, MG Road',
                'city'         => 'Mumbai',
                'state'        => 'Maharashtra',
                'pincode'      => '400001',
            ],
            [
                'first_name' => 'staff',
                'email' => 'staff@example.com',
                'password' => 'staff@2025',
                'role' => 'Staff',
                'gender' => 'Male',
                'phone_number' => '+91 1234567891',
                'address'      => '101 Galaxy Residency, MG Road',
                'city'         => 'Mumbai',
                'state'        => 'Maharashtra',
                'pincode'      => '400001',
            ],

        ];

        // Create users and assign roles
        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'first_name' => $userData['first_name'],
                    'password' => $userData['password'],
                    'role' => $userData['role'],
                    'gender' => $userData['gender'],
                    'address' => $userData['address'],
                    'city' => $userData['city'],
                    'state' => $userData['state'],
                    'pincode' => $userData['pincode'],

                ]
            );
            if ($user) {
                $user->assignRole($userData['role']);
            }
        }
    }
}
