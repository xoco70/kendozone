<?php
//
//namespace App;
//use Illuminate\Database\Query\Builder;
//
//class AssociationUser extends User implements UserInterface
//{
//
//
//    public function scopeForUser(Builder $query, User $user)
//    {
//        return $query->where('id', '=', $user->associationOwned->federation->id);
//        return $query->where('federation_id', '=', $user->federationOwned->id);
//    }
//
//    public function isAssociationBelongsToMyFederation(Association $association)
//    {
//        return ($this->isFederationPresident()
//            && $association->federation != null
//            && $this->federationOwned->id == $association->federation->id);
//
//    }
//
//    public function isClubBelongsToMyFederation(Club $club)
//    {
//
//    }
//
//}
