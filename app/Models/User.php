<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'department_id',
        'first_name',
        'last_name',
        'middle_name',
        'phone_number',
        'designation',
        'email',
        'password',
        'gender',
        'avatar',
        'role',
        'staff_id',
        'monthly_salary',
        'is_supervisor',
        'password_reset',
        'lock_unlock',
        'date_created',
        'supervisor_id',
        'can_be_assigned',
        'joining_date',
        'dob',
        'address',
        'city',
        'state',
        'pincode',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'user_id');
    }
}
