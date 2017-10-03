<?php

namespace App;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Model;

class Federation extends Model
{

    public $timestamps = true;
    protected $table = 'federation';
    protected $guarded = ['id'];

    public static function fillSelect()
    {
        // User is SuperAdmin
        $federations = Federation::pluck('name', 'id')->prepend('-', 0);
        return $federations;
    }

    public static function fillSelectForVueJs($user)
    {
        // User is SuperAdmin
        $federations = Federation::get(['id as value', 'name as text']);
        return $federations;
    }

    public function president()
    {
        return $this->hasOne(User::class, 'id', 'president_id');
    }

    public function associations()
    {
        return $this->hasMany(Association::Class);
    }

    public function clubs()
    {
        return $this->hasManyThrough(Club::class, Association::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::Class);
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
                return $query->where('id', '=', $user->federationOwned->id);

            case $user->isAssociationPresident() && $user->associationOwned:
                return $query->where('id', '=', $user->associationOwned->federation->id);

            case $user->isClubPresident() && $user->clubOwned:
                return $query->where('id', '=', $user->clubOwned->association->federation->id);
            default:
                throw new AuthorizationException();

        }
    }


}