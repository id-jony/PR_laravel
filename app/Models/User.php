<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fio',
        'phone',
        'uin',
        'pass',
    ];

    public function getShortPhoneAttribute()
    {
        $phone = substr_replace($this->phone, "+7(", 0, 0);
        $phone = substr_replace($phone, ") ", 6, 0);
        $phone = substr_replace($phone, "-", 11, 0);
        $phone = substr_replace($phone, "-", 14, 0);
        return $phone;
        // return sprintf('%s***', substr($this->phone, 0, 9));
    }

    public function getFirstFioAttribute()
    {
        $fio = explode(' ', $this->fio)[1];
         return mb_substr($fio, 0, 1);
    }

    public function getConvertFioAttribute()
    {   
         return mb_convert_case($this->fio, MB_CASE_TITLE, "UTF-8");
    }
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
}
