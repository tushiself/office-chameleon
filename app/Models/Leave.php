<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable = [
        'leave_type_id',
        'requested_days',
        'from_date',
        'to_date',
        'leave_status',
        'user_id',
        'remarks',
        'sick_file',
        'reviewed_by',
        'reviewed_date',
    ];

    public function leavetype()
    {
        return $this->belongsTo(LeaveType::class, 'leave_type_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
