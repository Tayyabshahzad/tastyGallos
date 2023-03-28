<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\CanResetPassword;
use Laravel\Passport\HasApiTokens;
class User extends Authenticatable  implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles,InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'status',
        'order_notification',


    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function franchise()
    {
        return $this->hasOne(Franchise::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }
    public function userdetail()
    {
        return $this->hasOne(UserDetail::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function refunds()
    {
        return $this->hasMany(Refund::class);
    }
    public function creditCard()
    {
        return $this->hasOne(CreditCard::class);
    }
    // public function sendPasswordResetNotification($token)
    // {
    //     $url = 'http://tastygallos.local/reset-password?token=' . $token;
    //     $this->notify(new ResetPasswordNotification($url));
    // }
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

}
