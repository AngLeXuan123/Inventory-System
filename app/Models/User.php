<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Spatie\Permission\Traits\HasRoles;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use HasApiTokens, HasFactory, Notifiable, Authenticatable, CanResetPassword, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
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

    public function desc()
    {
        return $this->hasMany(Desc::class);
    }  

    public function orders(){
        return $this->hasMany('App\Models\Order', 'user_id');
    }

    public function cart(){
        return $this->hasOne('App\Models\Cart','user_id');
    }

    public function isAdmin() {
        return $this->role === 'admin';
     }
 
     public function isUser() {
        return $this->role === 'user';
     }
}
