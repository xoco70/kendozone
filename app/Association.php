<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use OwenIt\Auditing\Contracts\Auditable;
use stdClass;

class Association extends Model implements Auditable
{

    public $timestamps = true;
    protected $table = 'association';
    protected $guarded = ['id'];
    use SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Same than fillSelect, but with VueJS Format
     * @param $user
     * @param $federationId
     * @return Collection
     */
    public static function fillSelectForVueJs($user, $federationId)
    {
        $associations = Association::where('federation_id', $federationId)
            ->get(['id as value', 'name as text']);
        if (sizeof($associations) == 0) {
            $object = new stdClass;
            $object->value = 0;
            $object->text = trans('structures.no_association_yet');
            $associations->push($object);
        };
        return $associations;
    }

    protected static function boot()
    {
        parent::boot();
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
        // Limit association to the same country
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

}