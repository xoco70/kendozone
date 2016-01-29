<?php

namespace App;

use App\Http\Requests\UserRequest;
use DateTime;
use GeoIP;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Webpatser\Countries\Countries;

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
    protected $fillable = ['name', 'firstname', 'lastname', 'email', 'password', 'grade_id', 'country_id', 'city', 'latitude', 'longitude', 'role_id', 'avatar', 'provider', 'provider_id', 'verified'];

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
    public static function uploadPic(UserRequest $request, $except = null)
    {
//        if (is_null($data))
        $data = $request->except($except);

        if (Input::hasFile('avatar') != null && Input::file('avatar')->isValid()) {

            $destinationPath = Config::get('constants.RELATIVE_AVATAR_PATH');
//            dd($destinationPath );
            $extension = Input::file('avatar')->getClientOriginalExtension(); // getting image extension
            $date = new DateTime();
            $timestamp = $date->getTimestamp();
            $fileName = trim($data['name']) . "_" . $timestamp; // renameing image
            $fileName = Str::slug($fileName, '-') . '.' . $extension;
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

    public function getAvatarAttribute($avatar)
    {

        if (is_null($avatar) || strlen($avatar) == 0) {
            $avatar = 'avatar.png';
        }

        if (!str_contains($avatar, 'http')) {

            $avatar = Config::get('constants.AVATAR_PATH') . $avatar;
        } else {

        }


        return $avatar;
    }

    /**
     * Set the password attribute.
     *
     * @param string $password
     */
//    public function setPasswordAttribute($password)
//    {
//        if (strlen($password) < 60) {
////            dd($password);
//            $this->attributes['password'] = bcrypt($password);
//        }else{
////            dd("Already Encrypted");
//        }
//
//    }


//    public function country()
//    {
//        return $this->hasOne('App\Country');
//    }
    public function grade()
    {
        return $this->belongsTo('App\Grade');
    }

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function settings()
    {
        return $this->hasOne('App\Settings');
    }

    public function invites()
    {
        return $this->hasMany('App\Invite', 'email', 'email');
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

//    public function isRegisteredInTournament($tournamentId)
//    {
//        $count = DB::table('category_tournament_user as ctu')
//            ->join('category_tournament as ct', 'ct.id', '=', 'ctu.category_tournament_id')
//            ->where('ctu.user_id',$this->id)
//            ->where('ct.tournament_id',$tournamentId)
//            ->count();
////        dd($count);
//        return $count > 0 ;
//    }


    public function categories()
    {
        return $this->belongsToMany('App\Category', 'category_tournament_user', 'user_id', 'category_tournament_id');
    }

    public function categoryTournaments()
    {
        return $this->belongsToMany(CategoryTournament::class);
    }
//    public function hasAtLeastOneTournament(){
//
//        return $this->tournaments()->first(); // Where not finished
//    }


    public static function insertCoordsInRequest(Request $request)
    {

        if ($request->isMethod('post')) {

            $location = GeoIP::getLocation(Config::get('constants.CLIENT_IP')); // Simulating IP in Mexico DF
            $country = Countries::where('name', '=', $location['country'])->first();
            if (is_null($country)) {
                $request->request->add(['country_id' => Config::get('constants.COUNTRY_ID_DEFAULT')]);
                $request->request->add(['city' => "Paris"]);
                $request->request->add(['latitude' => "48.858222"]);
                $request->request->add(['longitude' => "2.2945"]);

            } else {
                $country_id = $country->id;
                $request->request->add(['country_id' => $country_id]);
                $request->request->add(['city' => $location['city']]);
                $request->request->add(['latitude' => $location['lat']]);
                $request->request->add(['longitude' => $location['lon']]);
            }

        }
        return $request;

    }

    public static function generatePassword()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public function isSuperAdmin()
    {
        return Auth::user()->role_id == 1;
    }

    public function isOwner()
    {
        return Auth::user()->role_id == 2;
    }

    public function isAdmin()
    {
        return Auth::user()->role_id == 3;
    }

    public function isModerator()
    {
        return Auth::user()->role_id == 4;
    }

    public function isUser()
    {
        return Auth::user()->role_id == 5;
    }
}
