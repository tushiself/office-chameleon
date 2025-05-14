<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Faker\Factory as Faker;
use App\Models\User;

class DepartmentUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        // Get existing department IDs
        $departmentIds = Department::pluck('id')->take(10);

        foreach ($departmentIds as $index => $deptId) {
            User::create([
                'department_id'     => $deptId,
                'first_name'        => $faker->firstName,
                'last_name'         => $faker->lastName,
                'middle_name'       => $faker->firstName,
                'phone_number'      => $faker->phoneNumber,
                'designation'       => $faker->jobTitle,
                'address'      => '101 Galaxy Residency, MG Road',
                'city'         => 'Mumbai',
                'state'        => 'Maharashtra',
                'pincode'      => '400001',
                'email'             => $faker->unique()->safeEmail,
                'password'          => Hash::make('password'), // default password
                'gender'            => $faker->randomElement(['male', 'female']),
                'role'              => 'Staff',
                'staff_id'          => 'CHAM' . str_pad($index + 1, 3, '0', STR_PAD_LEFT), // CHAM001 to CHAM010
                'monthly_salary'    => $faker->numberBetween(25000, 60000),
                'is_supervisor'     => $faker->boolean,
                'password_reset'    => 0,
                'lock_unlock'       => 0,
                'supervisor_id'     => null,
                'can_be_assigned'   => 0,
                'joining_date'      => Carbon::now()->subYears(rand(1, 5))->format('Y-m-d'),
                'dob'               => Carbon::now()->subYears(rand(22, 40))->format('Y-m-d'),
                'remember_token'    => Str::random(10),
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);
        }
    }
}
