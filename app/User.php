<?php

namespace App;

use App\Http\Requests\UserRequest;
use DateTime;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
//use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;

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
     protected $fillable = ['name','firstname','lastname','email', 'password','avatar','grade_id','country_id','city','latitude','longitude', 'role_id','avatar','provider','provider_id','verified'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];


//    public function rules()
//    {
//        return [
//            'name' => 'required|max:255|unique:users',
//            'email' => 'required|max:255|unique:users',
//            'avatar' => 'mimes:png,jpg, jpeg, gif'
//        ];
//    }
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

    /**
     * @param Request $request
     * @return array
     */
    public static function uploadPic(UserRequest $request, $except=null)
    {
//        if (is_null($data))
        $data = $request->except($except);

        if (Input::hasFile('avatar') != null && Input::file('avatar')->isValid()) {
            $destinationPath = Config::get('constants.RELATIVE_AVATAR_PATH');
            $extension = Input::file('avatar')->getClientOriginalExtension(); // getting image extension
            $date = new DateTime();
            $timestamp = $date->getTimestamp();
            $fileName = trim($data['name']) . "_" . $timestamp ; // renameing image
            $fileName = Str::slug($fileName, '-'). '.' . $extension;
//            dd($destinationPath, $fileName);
            if (!Input::file('avatar')->move($destinationPath, $fileName)) {
                flash("error", "La subida del archivo ha fallado, vuelve a subir su foto por favor");
                return $data;
            } else {
                $data['avatar'] = $fileName;
                return $data;

            }
        }
        return $data;
    }
//    public function setAvatarAttribute($avatar){
//
//        if (!is_null($avatar) && is_file($avatar)){
//            $extension = $avatar->getClientOriginalExtension(); // getting image extension
//            $date = new DateTime();
//            $timestamp =  $date->getTimestamp();
//            $fileName = $timestamp.'.'.$extension; // renameing image
//            $this->attributes['avatar'] = $fileName;
//            dd($fileName);
//
//
//        }else{
//            dd("isNull");
//        }
//    }

    public function getAvatarAttribute($avatar){

        if (is_null($avatar) ||strlen($avatar)==0){
            $avatar = 'avatar.png';
        }

        if (!str_contains($avatar, 'http')){

            $avatar = Config::get('constants.AVATAR_PATH').$avatar;
        }else{

        }


        return $avatar;
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


//    public function country()
//    {
//        return $this->hasOne('App\Country');
//    }
    public function grade()
    {
        return $this->hasOne('App\Grade');
    }

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function settings()
    {
        return $this->hasOne('App\Settings');
    }

    public function country()
    {
        return $this->belongsTo('Webpatser\Countries\Countries');
    }

    /**
     * A user can have many tournaments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tournaments()
    {
        return $this->hasMany('App\Tournament');
    }


    public function hasAtLeastOneTournament(){

        return $this->tournaments()->first(); // Where not finished
    }


}
