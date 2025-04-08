<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
         'email', 'password', 'role', 'status', 'last_login', 'email_verified_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $dates = ['email_verified_at'];

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
            'last_login' => 'datetime'
        ];
    }

    /**
     * Get the user profile associated with the user.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class, 'user_id', 'id');
    }

    public function qrCode()
    {
        return $this->hasOne(QRCodes::class, 'user_id');
    }

    public function medicalInfo()
    {
        return $this->hasOne(MedicalInfo::class, 'user_id');
    }
}
