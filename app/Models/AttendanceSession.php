<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceSession extends Model
{
    protected $fillable = [
        'attendance_id',
        'start_time',
        'end_time',
    ];

    protected $dates = ['start_time', 'end_time'];

    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }
}
