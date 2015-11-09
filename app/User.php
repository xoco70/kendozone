<?php

namespace App;

use DateTime;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;

class User extends \Cartalyst\Sentinel\Users\EloquentUser implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /* 
    public function rules()
    {
        return [
            'image'       => 'mimes:png,jpg, jpeg, gif'
        ];
    }
    public function setPictureAttribute($picture){
        $extension = $picture->getClientOriginalExtension(); // getting image extension
        $date = new DateTime();
        $timestamp =  $date->getTimestamp();
        $fileName = $timestamp.'.'.$extension; // renameing image
        $this->attributes['picture'] = $fileName;
    }
//    public function getPictureAttribute($picture){
//        return is_null($picture) ? 'avatar.png' : $picture;
//    }
*/
}
