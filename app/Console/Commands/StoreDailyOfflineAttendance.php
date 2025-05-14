<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Attendance;
use Carbon\Carbon;

class StoreDailyOfflineAttendance extends Command
{
    protected $signature = 'attendance:store-offline';
    protected $description = 'Store offline attendance for all users daily at 9:00 PM';

    public function handle()
    {
        $today = Carbon::today();

        // Get only staff users
        $users = User::where('role', 'Staff')->get();

        foreach ($users as $user) {
            $alreadyMarked = Attendance::where('user_id', $user->id)
                ->whereDate('date', $today)
                ->exists();

            if (!$alreadyMarked) {
                Attendance::create([
                    'user_id' => $user->id,
                    'date' => $today,
                    'check_in_type' => 'offline',
                    'time_in' => null,
                    'time_out' => null,
                    'is_paused' => true,
                    'duration' => 0,
                    'total_hours' => 0,
                    'last_updated_at' => null,
                ]);
            }
        }

        $this->info('Offline attendance stored successfully for staff.');
    }
}
