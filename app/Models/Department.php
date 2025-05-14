<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name',
        'description',
        'logo',
        'status'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'department_id');
    }
}
