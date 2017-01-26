<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use OwenIt\Auditing\AuditingTrait;
use stdClass;

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
            //TODO Unlink all clubs/users from assoc

        });
        static::restoring(function ($tournament) {
        });

    }

    /**
     * An association has only 1 President
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function president()
    {
        return $this->hasOne(User::class, 'id', 'president_id');
    }

    /**
     * An association has Many Clubs
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clubs()
    {
        return $this->hasMany(Club::class);
    }

    /**
     * An association belongs To a Federations
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function federation()
    {
        return $this->belongsTo(Federation::class);
    }

    /**
     * Filter the assocation List depending on the user type
     * Ex : SuperAdmin See all, Federation President only see his Associations, etc
     * @param $query
     * @param User $user
     */
    public function scopeForUser($query, User $user)
    {
        if (!$user->isSuperAdmin()) {
            $query->whereHas('federation', function ($query) use ($user) {
                $query->where('country_id', $user->country_id);
            });
        }
    }

    /**
     * Check if an Association is in the same Federation than a Federation President
     * @param User $user
     * @return bool
     */
    public function belongsToFederationPresident(User $user)
    {
        if ($user->isFederationPresident() &&
            $user->federationOwned != null &&
            $this->federation->id == $user->federationOwned->id
        )
            return true;
        return false;
    }

    /**
     * Check if an Association is in the same Association than a Association President
     * @param User $user
     * @return bool
     */
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

    /**
     * Fill Selects depending on the Logged user type
     * @return Collection
     */
    public static function fillSelect()
    {
        $associations = new Collection();
        if (Auth::user()->isSuperAdmin()) {
            $associations = Association::pluck('name', 'id')->prepend('-', 0);
        } else if (Auth::user()->isFederationPresident()) {
            $associations = Auth::user()->federationOwned->associations->pluck('name', 'id')->prepend('-', 0);
        } else if (Auth::user()->isAssociationPresident()) {
            $association = Auth::user()->associationOwned;
            $associations->push($association);
            $associations = $associations->pluck('name', 'id');
        } else if (Auth::user()->isClubPresident()) {
            $association = Auth::user()->clubOwned->association;
            $associations->push($association);
            $associations = $associations->pluck('name', 'id')->prepend('-', 0);
        }
        return $associations;
    }

    /**
     * Same than fillSelect, but with VueJS Format
     * @param $user
     * @param $federationId
     * @return Collection
     */
    public static function fillSelectForVueJs($user, $federationId)
    {
        $associations = new Collection();
        if ($user->isSuperAdmin()) {
            $associations = Association::where('federation_id', $federationId)
                ->get(['id as value', 'name as text']);
        } else if ($user->isFederationPresident()) {
            $associations = $user->federationOwned->associations()
                ->where('federation_id', $federationId)
                ->get(['id as value', 'name as text']);
        } else if ($user->isAssociationPresident()) {
            $associations = $user->associationOwned()
                ->where('federation_id', $federationId)
                ->get(['id as value', 'name as text']);;
        } else if ($user->isClubPresident()) {
            $associations = $user->clubOwned->association()
                ->where('federation_id', $federationId)
                ->get(['id as value', 'name as text']);
        } else if ($user->isUser()) {
            $associations = Association::where('federation_id', $federationId)
                ->get(['id as value', 'name as text'])
                ->prepend(['value' => '0', 'text' => '-']);

        }
        if (sizeof($associations) == 0) {
            $object = new stdClass;
            $object->value = 0;
            $object->text = trans('core.no_association_yet');
            $associations->push($object);
        };
        return $associations;
    }

}