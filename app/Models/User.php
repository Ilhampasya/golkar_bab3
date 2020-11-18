<?php

namespace App\Models;

use Avatar;
use App\Notifications\RegistrationMail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, MustVerifyEmailTrait;

    protected $with = [
        'role'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
        'meta',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'api_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function markEmailAsVerified()
    {
        return $this->forceFill([
            'api_token' => hash('sha256', $this->email),
            'email_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new RegistrationMail);
    }

    public function getPhotoAttribute()
    {
        if (!($photo = $this->attributes['photo'])) {
            $photo = (string) Avatar::create($this->name)->toBase64();
        }

        return $photo;
    }
}
