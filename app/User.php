<?php

namespace App;

use DateTime;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
//use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Config;
//use Illuminate\Support\Facades\Input;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, HasRole;

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
     protected $fillable = ['name','firstname','lastname','email', 'password','gradeId','countryId', 'roleId','avatar','provider','provider_id','verified'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];


    public function rules()
    {
        return [
            'name' => 'required|max:255|unique:users',
            'email' => 'required|max:255|unique:users',
            'avatar' => 'mimes:png,jpg, jpeg, gif'
        ];
    }
    /**
     * Boot the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            $user->token = str_random(30);
        });
    }
    /**
     * Confirm the user.
     *
     * @return void
     */
    public function confirmEmail()
    {
        $this->verified = true;
        $this->token = null;
        $this->save();
    }
    public function setPictureAttribute($avatar){
        if (!is_null($avatar) && is_file($avatar)){
            $extension = $avatar->getClientOriginalExtension(); // getting image extension
            $date = new DateTime();
            $timestamp =  $date->getTimestamp();
            $fileName = $timestamp.'.'.$extension; // renameing image
            $this->attributes['avatar'] = $fileName;
        }
    }

    public function getPictureAttribute($avatar){
        return is_null($avatar) ? 'avatar.png' : $avatar;
    }
    /**
     * Set the password attribute.
     *
     * @param string $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }


}
