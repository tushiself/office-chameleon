<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    protected $fillable = [
        'leave_type',
        'description',
        'assign_days',
        'status',
        'apply_base',
        'paid_type',
        'early_leave',
    ];
}
