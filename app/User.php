<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable, LaratrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    const TABLE_NAME = "users";
    
    const ID =  "id";
    const NAME = "name";
    const EMAIL = "email";
    const PASSWORD = "password";
    const EMAIL_VERIFIED_AT = "email_varified_at";
    const REMEMBER_TOKEN ="remember_token";


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::NAME,
        self::EMAIL,
        self::PASSWORD,
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        self::PASSWORD,
        self::REMEMBER_TOKEN
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function identities() {
        return $this->hasMany('App\SocialAuth');
     }
}
