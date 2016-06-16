<?php

namespace App;

use Illuminate\Contracts\Validation\UnauthorizedException;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Countries\Countries;

class Federation extends Model
{

    protected $table = 'federation';
    public $timestamps = true;

    protected $guarded = ['id'];



    public function president()
    {
        return $this->hasOne(User::class,'id','president_id');
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


    public function associations()
    {
        return $this->hasMany(Association::Class);
    }

    public function country()
    {
        return $this->belongsTo(Countries::Class);
    }

    /**
     * @param $query
     * @param User $user
     * @return mixed
     */
    public function scopeForUser($query, User $user)
    {
        if ($user->isSuperAdmin()) {
            return $query;
        } else if ($user->isFederationPresident() && $user->federationOwned!=null){
            return $query->where('id', '=', $user->federationOwned->id);
        }  else if ($user->isAssociationPresident() && $user->associationOwned){
            return $query->where('id', '=', $user->associationOwned->federation->id);
        } else if ($user->isClubPresident() && $user->clubOwned){
            return $query->where('id', '=', $user->clubOwned->association->federation->id);
        } else{
            throw new UnauthorizedException();
        }
    }

}