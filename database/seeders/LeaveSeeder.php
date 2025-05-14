<?php

namespace Database\Seeders;

use App\Models\Leave;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LeaveSeeder extends Seeder
{
    public function run()
    {
        $data = Leave::insert([
            [
                'leave_type_id'   => 1,
                'user_id'         => 1,
                'requested_days'  => 2,
                'from_date'       => '2025-05-10',
                'to_date'         => '2025-05-11',
                'leave_status'    => '1',
                'remarks'         => 'Family function',
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
            ],
           
        ]);
    }
}
