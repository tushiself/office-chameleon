<?php

namespace Database\Seeders;

use App\Models\Attendance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Carbon;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $today = Carbon::today()->toDateString();

        // Get only non-admin/manager user IDs
        $users = User::whereNotIn('role', ['Admin', 'Manager'])->pluck('id');

        foreach ($users as $userId) {
            Attendance::insert([
                'user_id' => $userId,
                'date' => $today,
                'time_in' => '09:00:00',
                'check_in_type' => ['free', 'working'][rand(0, 1)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
