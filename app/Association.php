<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use OwenIt\Auditing\AuditingTrait;

class Association extends Model
{

    protected $table = 'association';
    public $timestamps = true;
    protected $guarded = ['id'];
    use SoftDeletes;
    use AuditingTrait;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];


    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($association) {

//            $association->clubs
            //TODO Unlink all clubs/users from assoc
//            foreach ($tournament->championships as $ct) {
//                $ct->delete();
//            }
//            $tournament->invites()->delete();

        });
        static::restoring(function ($tournament) {

//            foreach ($tournament->championships()->withTrashed()->get() as $ct) {
//                $ct->restore();
//            }

        });

    }

    public function president()
    {
        return $this->hasOne(User::class, 'id', 'president_id');
    }

    public function clubs()
    {
        return $this->hasMany(Club::class);
    }

    public function federation()
    {
        return $this->belongsTo(Federation::class);
    }

    public function scopeForUser($query, User $user)
    {
        if (!$user->isSuperAdmin()) {
            $query->whereHas('federation', function ($query) use ($user) {
                $query->where('country_id', $user->country_id);
            });
        }
    }

    public function belongsToFederationPresident(User $user)
    {
        if ($user->isFederationPresident() &&
            $user->federationOwned != null &&
            $this->federation->id == $user->federationOwned->id
        ) {

            return true;
        }
        return false;
    }

    public function belongsToAssociationPresident(User $user)
    {
        if ($user->isAssociationPresident() &&
            $user->associationOwned != null &&
            $this->id == $user->associationOwned->id
        ) {
            return true;
        }
        return false;
    }

    public static function fillSelect()
    {
        $associations = new Collection();
        if (Auth::user()->isSuperAdmin()) {
            $associations = Association::pluck('name', 'id');
        } else if (Auth::user()->isFederationPresident()) {
            $associations = Auth::user()->federationOwned->associations->pluck('name', 'id');
        } else if (Auth::user()->isAssociationPresident()) {
            $association = Auth::user()->associationOwned;
            $associations->push($association);
            $associations = $associations->pluck('name', 'id');
        } else if (Auth::user()->isClubPresident()) {
            $association = Auth::user()->clubOwned->association;
            $associations->push($association);
            $associations = $associations->pluck('name', 'id');
        }
        return $associations;
    }

}