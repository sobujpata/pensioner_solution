<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employer extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'fname',
        'org_name',
        'designation',
        'email',
        'mobile',
        'password',
        'image_url',
        'otp',
        'status',
        'image_url'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $attributes = [
        'otp' => '0',
        'status' => '0',
        'image_url' => 'uploads/images/default.jpg',
    ];


    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Scope for filtering active users.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
