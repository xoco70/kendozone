<?php

namespace App\Traits;

trait RoleTrait
{
    /**
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->role_id == config('constants.ROLE_SUPERADMIN');
    }

    /**
     * @return bool
     */
    public function isFederationPresident()
    {
        return $this->role_id == config('constants.ROLE_FEDERATION_PRESIDENT');
    }

    /**
     * @return bool
     */
    public function isAssociationPresident()
    {
        return $this->role_id == config('constants.ROLE_ASSOCIATION_PRESIDENT');
    }

    /**
     * @return bool
     */
    public function isClubPresident()
    {
        return $this->role_id == config('constants.ROLE_CLUB_PRESIDENT');
    }

    /**
     * @return bool
     */
    public function isUser()
    {
        return $this->role_id == config('constants.ROLE_USER');
    }

    /**
     * @return bool
     */
    public function isUserOrMore()
    {
        return $this->role_id <= config('constants.ROLE_USER');
    }

    /**
     * @param $tournament
     * @return bool
     */
    public function isOwner($tournament)
    {
        return $tournament->user_id == $this->id;
    }
}