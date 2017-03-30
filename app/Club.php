<?php

namespace App;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use OwenIt\Auditing\AuditingTrait;
use stdClass;

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

            //TODO Unlink all clubs/users from assoc
        });
        static::restoring(function ($club) {
        });

    }

    /**
     * A Club has only a President
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function president()
    {
        return $this->hasOne(User::class, 'id', 'president_id');
    }

    /**
     * A Club has many practicants
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function practicants()
    {
        return $this->hasMany('User');
    }

    /**
     * A Club belongs to an Association
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function association()
    {
        return $this->belongsTo(Association::class);
    }

    /**
     * Get the Federation that federate the Club
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function federation()
    {
        if ($this->association != null)
            return $this->association->federation();
        else
            return $this->association(); //TODO THIS IS BAD :(

    }


    /**
     * Filter the Club List depending on the user type
     * Ex : SuperAdmin See all, Federation President only see his Clubs, etc
     * @param $query - The builder
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

    /**
     * Check if the Club is in the same Federation than a Federation President
     * @param User $user
     * @return bool
     */
    public function belongsToFederationPresident(User $user) // Should be FederationUser????
    {
        return
            $user->federationOwned != null &&
            $user->federationOwned->id == $this->federation_id;

    }

    /**
     * Check if the Club is in the same Association than a Association President
     * @param User $user
     * @return bool
     */
    public function belongsToAssociationPresident(User $user)
    {
        return $user->associationOwned != null &&
            $this->association != null &&
            $user->associationOwned->id == $this->association->id;

    }

    /**
     * Check if the Club is in the same Association than a Club President
     * @param User $user
     * @return bool
     */
    public function belongsToClubPresident(User $user)
    {
        return $user->clubOwned != null &&
            $user->clubOwned->id == $this->id;

    }

    /**
     * Fill Selects depending on the Logged user type
     * @return Collection
     */
    public static function fillSelect($federationId, $associationId)
    {
        if ($associationId == 0 || $associationId == null ) {
            // Get list of associations in the federation
            $clubs = Club::where('federation_id', $federationId)->pluck('name', 'id');
        } else if ($federationId != 0) {
            $clubs = Club::where('association_id', $associationId)->pluck('name', 'id');
        } else {
            dd("you re fucked - v2");
        }


//        $clubs = new Collection();
//        if (Auth::user()->isSuperAdmin()) {
//            $clubs = Club::pluck('name', 'id');
//        } else if (Auth::user()->isFederationPresident() && Auth::user()->federationOwned != null) {
//            $clubs = Auth::user()->federationOwned->clubs;
//        } else if (Auth::user()->isAssociationPresident() && Auth::user()->associationOwned != null) {
//            $clubs = Auth::user()->associationOwned->clubs->pluck('name', 'id');
//        } else if (Auth::user()->isClubPresident() && Auth::user()->clubOwned != null) {
//            $clubs = Auth::user()->clubOwned;
//        }
        return $clubs;
    }

    /**
     * Same than fillSelect, but with VueJS Format
     * @param User $user
     * @param $federationId
     * @param $associationId
     * @return Collection
     */
    public static function fillSelectForVueJs(User $user, $federationId, $associationId)
    {
        if ($associationId == 0) {
            // Get list of associations in the federation
            $clubs = Club::where('federation_id', $federationId)
                ->get(['id as value', 'name as text']);
        } else if ($federationId != 0) {
            $clubs = Club::where('association_id', $associationId)
                ->get(['id as value', 'name as text']);
        } else {
            dd("you re fucked");
        }


//        if ($user->isSuperAdmin()) {
//
//        } else if ($user->isFederationPresident() && $user->federationOwned != null) {
//            $clubs = $user->federationOwned->clubs()
//                ->where('association_id', $associationId)
//                ->get(['club.id as value', 'club.name as text']);
//        } else if ($user->isAssociationPresident() && $user->associationOwned != null) {
//            $clubs = $user->associationOwned->clubs()
//                ->where('association_id', $associationId)
//                ->get(['club.id as value', 'club.name as text']);
//        } else if ($user->isClubPresident() && $user->clubOwned != null) {
//            $clubs = $user->clubOwned()
//                ->where('association_id', $associationId)
//                ->get(['club.id as value', 'club.name as text']);
//        } else if ($user->isUser()) {
//            $clubs = Club::where('association_id', $associationId)
//                ->get(['id as value', 'name as text'])
//                ->prepend(['value' => '0', 'text' => '-']);
//        }

//        if (sizeof($clubs) == 0) {
//            $object = new stdClass;
//            $object->value = 0;
//            $object->text = trans('core.no_club_available');
//            $clubs->push($object);
//        };

        return $clubs;
    }


}
