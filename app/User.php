<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use DateTime;
use GeoIP;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use OwenIt\Auditing\AuditingTrait;
use Thomaswelton\LaravelGravatar\Facades\Gravatar;
use Webpatser\Countries\Countries;

/**
 * @property  mixed name
 * @property  mixed email
 * @property  mixed password
 * @property bool verified
 * @property mixed token
 */
class User extends Model implements AuthenticatableContract, CanResetPasswordContract, SluggableInterface
{
    use Authenticatable, Authorizable, CanResetPassword, HasRole, SoftDeletes, SluggableTrait, AuditingTrait;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
//    protected $appends = [''];

    protected $sluggable = [
        'build_from' => 'email',
        'save_to' => 'slug',
    ];

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

    /**
     * Boot the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            $softDeletedUser = User::onlyTrashed()->where('email', '=', $user->email)->first();
            if ($softDeletedUser != null) {
                $softDeletedUser->restore();
                return false;
            } else {
                $user->token = str_random(30);
                $user->addGeoData();

            }
            return true;
        });

        // If a User is deleted, you must delete:
        // His tournaments, his tcus

        static::deleting(function ($user) {
//            foreach
//            $user->tournaments()->delete();
            foreach ($user->tournaments as $tournament) {
                $tournament->delete();
            }
            $user->categoryTournamentUsers()->delete();

        });
        static::restoring(function ($user) {
            $user->categoryTournamentUsers()->withTrashed()->restore();
            foreach ($user->tournaments()->withTrashed()->get() as $tournament) {
                $tournament->restore();
            }

        });
    }
    /**
     * @param $attributes
     * @return static $user
     */
    public static function registerUserToCategory($attributes)
    {
        $user = User::where(['email' => $attributes['email']])->withTrashed()->first();

        $password = null;
        if ($user == null) {
            $user = new User;
            $user->name = $attributes['name'];
            $user->email = $attributes['email'];
            $password = User::generatePassword();
            $user->password = bcrypt($password);
            $user->verified = 1;
            $user->save();
            $user->clearPassword = $password;
        }
        // If user is deleted, this is restoring the user only, but not his asset ( tournaments, categories, etc.)
        else if ($user->isDeleted()) {
            $user->deleted_at = null;
            $user->save();
        }

        // Fire Events

        return $user;
    }

    function addGeoData()
    {
        $location = GeoIP::getLocation(getIP()); // Simulating IP in Mexico DF
        $country = Countries::where('name', '=', $location['country'])->first();
        if (is_null($country)) {
            $countryId = Config::get('constants.COUNTRY_ID_DEFAULT');
            $city = "Paris";
            $latitude = 48.858222;
            $longitude = 2.2945;

        } else {
            $countryId = $country->id;
            $city = $location['city'];
            $latitude = $location['lat'];
            $longitude = $location['lon'];

        }
        $this->country_id = $countryId;
        $this->city = $city;
        $this->latitude = $latitude;
        $this->longitude = $longitude;


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
     * @param $data
     * @return array
     */
    public static function uploadPic($data)
    {
        $file = array_first(Input::file(), null);

        if ($file != null && $file->isValid()) {

            $destinationPath = Config::get('constants.RELATIVE_AVATAR_PATH');
            $date = new DateTime();
            $timestamp = $date->getTimestamp();
            $ext = $file->getClientOriginalExtension();
            $fileName = $timestamp . "_" . $file->getClientOriginalName();
            $fileName = Str::slug($fileName, '-') . "." . $ext;

            if (!$file->move($destinationPath, $fileName)) {
                flash()->error("La subida del archivo ha fallado, vuelve a subir su foto por favor");
                return $data;
            } else {
                $data['avatar'] = $fileName;
                // Redimension and pic
                $img = Image::make($destinationPath . $fileName);
                if ($img->width() > $img->height()) {
                    $img->resize(200, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                } else {
                    $img->resize(null, 200, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }
//                $img->crop(200, 200, 0, 0);
                $img->save($destinationPath . $fileName);
//                flash("success", "La subida del archivo ha fallado, vuelve a subir su foto por favor");


                return $data;
            }
        }
        return $data;
    }


    public function getAvatarAttribute($avatar)
    {

        if (is_null($avatar) || strlen($avatar) == 0) {
            // Check if it has gravatar
            if (Gravatar::exists($this->email)) {
                $avatar = Gravatar::src($this->email);
            } else {
                $avatar = 'avatar.png';
            }

        }

        if (!str_contains($avatar, 'http')) {

            $avatar = Config::get('constants.AVATAR_PATH') . $avatar;
        } else {

        }
        return $avatar;
    }

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

    public function tournamentsInvited()
    {
        return $this->hasManyThrough('App\Invite', 'App\Tournament');
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

    public function categories()
    {
        return $this->belongsToMany('App\Category', 'category_tournament_user', 'user_id', 'category_tournament_id');
    }

    public function categoryTournaments()
    {
        return $this->belongsToMany(CategoryTournament::class)
            ->withTimestamps();
    }

    public function categoryTournamentUsers()
    {
        return $this->hasMany(CategoryTournamentUser::class);
    }

    public function myTournaments()
    {
//        return User::with('')->find($this->id);
        return Tournament::leftJoin('category_tournament', 'category_tournament.tournament_id', '=', 'tournament.id')
            ->leftJoin('category_tournament_user', 'category_tournament_user.category_tournament_id', '=', 'category_tournament.id')
            ->where('category_tournament_user.user_id', '=', $this->id)
            ->select('tournament.*')
            ->distinct();
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
        return $this->role_id == Config::get('constants.ROLE_SUPERADMIN');
    }

    public function isOwner()
    {
        return $this->role_id == Config::get('constants.ROLE_OWNER');
    }

    public function isAdmin()
    {
        return $this->role_id == Config::get('constants.ROLE_ADMIN');
    }

    public function isModerator()
    {
        return $this->role_id == Config::get('constants.ROLE_PRESIDENT');
    }

    public function isUser()
    {
        return $this->role_id == Config::get('constants.ROLE_USER');
    }

    public function isDeleted()
    {
        return $this->deleted_at != null;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function owns(Tournament $tournament)
    {
        return $this->id == $tournament->user_id;
    }


    public function canEditTournament($tournament)
    {
        return ($this->id == $tournament->user_id || $this->isSuperAdmin());
    }

    public function canEditUser($user)
    {
        return ($this->id == $user->user_id || $this->isSuperAdmin());
    }

}
