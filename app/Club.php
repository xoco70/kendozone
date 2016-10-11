<?php

namespace App;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use OwenIt\Auditing\AuditingTrait;

class Club extends Model
{

    protected $table = 'club';
    public $timestamps = true;
    protected $guarded = ['id'];
    use SoftDeletes;
    use AuditingTrait;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];


    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($club) {

//            $club->clubs
            //TODO Unlink all clubs/users from assoc
//            foreach ($tournament->championships as $ct) {
//                $ct->delete();
//            }
//            $tournament->invites()->delete();

        });
        static::restoring(function ($club) {

//            foreach ($tournament->championships()->withTrashed()->get() as $ct) {
//                $ct->restore();
//            }

        });

    }

    public function president()
    {
        return $this->hasOne(User::class, 'id', 'president_id');
    }

//    public function vicepresident()
//    {
//        return $this->hasOne(User::class,'id','vicepresident_id');
//    }
//
//    public function secretary()
//    {
//        return $this->hasOne(User::class,'id','secretary_id');
//    }
//
//    public function treasurer()
//    {
//        return $this->hasOne(User::class,'id','treasurer_id');
//    }

//    public function admin()
//    {
//        return $this->hasOne(User::class,'id','admin_id');
//    }


    public function practicants()
    {
        return $this->hasMany('User');
    }

    public function association()
    {
        return $this->belongsTo(Association::class);
    }

    public function federation()
    {
        if ($this->association != null)
            return $this->association->federation();
        else
            return $this->association();
    }


    /**
     * @param $query
     * @param User $user
     * @return Builder
     * @throws AuthorizationException
     */
    public function scopeForUser($query, User $user)
    {
        switch (true) {
            case $user->isSuperAdmin():
                return $query;
            case $user->isFederationPresident() && $user->federationOwned != null:
                return $query->where('federation_id', $user->federationOwned->id);
            case
                $user->isAssociationPresident() && $user->associationOwned:
                return $query->whereHas('association', function ($query) use ($user) {
                    $query->where('id', $user->associationOwned->id);
                });
            case $user->isClubPresident() && $user->clubOwned:
                return $query->where('id', $user->clubOwned->id);
            default:
                throw new AuthorizationException();
        }


    }

    public function belongsToFederationPresident(User $user) // Should be FederationUser????
    {
        return
            $user->federationOwned != null &&
            $user->federationOwned->id == $this->federation_id;

    }

    public function belongsToAssociationPresident(User $user)
    {
        return $user->associationOwned != null &&
        $this->association != null &&
        $user->associationOwned->id == $this->association->id;

    }

    public function belongsToClubPresident(User $user)
    {
        return $user->clubOwned != null &&
        $user->clubOwned->id == $this->id;

    }

    public static function fillSelect()
    {
        $clubs = new Collection();
        if (Auth::user()->isSuperAdmin()) {
            $clubs = Club::pluck('name', 'id');
        } else if (Auth::user()->isFederationPresident() && Auth::user()->federationOwned != null) {
            $clubs = Auth::user()->federationOwned->clubs;
        } else if (Auth::user()->isAssociationPresident() && Auth::user()->associationOwned != null) {
            $clubs = Auth::user()->associationOwned->clubs->pluck('name', 'id');
        } else if (Auth::user()->isClubPresident() && Auth::user()->clubOwned != null) {
            $clubs = Auth::user()->clubOwned;
        }
        return $clubs;
    }

    public static function fillSelectForVueJs(User $user, $associationId)
    {
        $clubs = new Collection();
        if ($user->isSuperAdmin()) {
            $clubs = Club::get(['id as value', 'name as text']);
        } else if ($user->isFederationPresident() && $user->federationOwned != null) {
            $clubs = $user->federationOwned->clubs()
                ->where('association_id', $associationId)
                ->get(['club.id as value', 'club.name as text']);
        } else if ($user->isAssociationPresident() && $user->associationOwned != null) {
            $clubs = $user->associationOwned->clubs()
                ->where('association_id', $associationId)
                ->get(['club.id as value', 'club.name as text']);
        } else if ($user->isClubPresident() && $user->clubOwned != null) {
            $clubs = $user->clubOwned()
                ->where('association_id', $associationId)
                ->get(['club.id as value', 'club.name as text']);
        } else if ($user->isUser()) {
            $clubs = Club::where('association_id', $associationId)
                ->get(['id as value', 'name as text'])
                ->prepend(['value' => '0', 'text' => '-']);
        }
        return $clubs;
    }


}
