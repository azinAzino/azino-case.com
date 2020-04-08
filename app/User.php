<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    const ROLE_USER = 1;
    const ROLE_ADMIN = 10;
    const ROLE_MANAGER = 11;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'avatar',
        'role',
        'is_yt',
        'login',
        'login2',
        'deposit',
        'money',
        'ref_user',
        'profit',
        'opened',
        'ref_link',
        'deposit',
        'bonus_money',
        'manager_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function manager(){
        return $this->belongsTo('App\User', 'manager_id');
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function generatePassword()
    {

        $chars = "qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
        $max = 8;
        $size = StrLen($chars) - 1;
        $password = null;
        while ($max--) $password .= $chars[rand(0, $size)];
        return $password;
    }

    public static function generateEmail()
    {

        // $email = false;
        // $chars="qazxswedcvfrtgbnhyujmkiolp";
        // $max=10;
        // $size=StrLen($chars)-1;
        // $email = null;

        // do{

        //     while($max--) $email .= $chars[rand(0,$size)];
        //     $email = $email . '@azinocase.com';
        //     $user = User::where('email', $email)->get();
        //     if(!empty($user->toArray())) $email = null;

        // } while (!$email);

        // return $email;

    }
}
