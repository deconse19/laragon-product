<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        
        'name',
        'email',
        'password',
        'email_verified_at',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',

    ];

    // public function sendEmailVerificationNotification()
    // {
    //     $this->notify(new CustomVerifyEmail());
    // }

    public function setNameAttribute($value)
    {
        return $this->attributes['name'] = ucwords($value);
    }
    

    public function userProfile(){

        return $this->hasOne(UserProfile::class);
    }


    
    public function transaction(){

        return $this->hasMany(Transaction::class);
    }
}


