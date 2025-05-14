<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginActivity extends Model
{
    // app/Models/LoginActivity.php
    protected $fillable = [
        'user_id',
        'ip',
        'device',
        'platform',
        'platform_version',
        'browser',
        'browser_version',
        'is_mobile',
        'user_agent'
    ];
}
