<?php

namespace Database\Seeders;

use App\Models\LeaveType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        LeaveType::insert([
            [
                'leave_type' => 'Casual Leave',
                'description' => 'Used for personal matters or relaxation',
                'assign_days' => 12,
                'apply_base' => 'year',
                'paid_type' => 'paid',
                'early_leave' => 1,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'leave_type' => 'Sick Leave',
                'description' => 'For illness or medical needs',
                'assign_days' => 8,
                'apply_base' => 'year',
                'paid_type' => 'paid',
                'early_leave' => 0,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'leave_type' => 'Unpaid Leave',
                'description' => 'Leave without pay for emergencies',
                'assign_days' => 5,
                'apply_base' => 'year',
                'paid_type' => 'unpaid',
                'early_leave' => 0,
                'status' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
