<?php

namespace App;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use OwenIt\Auditing\AuditingTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Club extends Model implements Auditable
{
    public $timestamps = true;
    protected $table = 'club';
    protected $guarded = ['id'];
    use SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Fill Selects depending on the Logged user type
     * @return Collection
     */
    public static function fillSelect($federationId, $associationId)
    {
        if ($associationId == 0 || $associationId == null) {
            // Get list of associations in the federation
            $clubs = Club::where('federation_id', $federationId)->pluck('name', 'id');
        } else if ($federationId != 0) {
            $clubs = Club::where('association_id', $associationId)->pluck('name', 'id');
        } else {
            $clubs = new Collection;
        }
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
            $clubs = new Collection;
        }
        return $clubs;
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
     * A Club belongs to an Association
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function association()
    {
        return $this->belongsTo(Association::class);
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
        return
            $user->clubOwned != null &&
            $user->clubOwned->id == $this->id;
    }


}
