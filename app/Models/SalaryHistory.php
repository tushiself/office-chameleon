<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalaryHistory extends Model
{
    protected $fillable = [
        'user_id',
        'month',
        'year',
        'monthly_salary',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
