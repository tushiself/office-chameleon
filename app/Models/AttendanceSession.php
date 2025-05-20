<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceSession extends Model
{
    protected $fillable = [
        'attendance_id',
        'time_in',
        'end_time',
        'duration_seconds'
    ];


    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }
}
