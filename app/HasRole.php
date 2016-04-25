<?php
namespace App;
trait HasRole
{
    /**
     * A user may have multiple roles. --> A user must have one role
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany --> BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class,'role_id', 'id');
    }
    /**
     * Determine if the user has the given role.
     *
     * @param  mixed $role
     * @return boolean
     */
    public function hasRole($role)
    {

        if (is_string($role)) {
            return $this->role->equals('name', $role);
        }
        
        return  $role->contains($this->role);

    }

    /**
     * Determine if the user may perform    the given permission.
     *
     * @param  Permission $permission
     * @return boolean
     */
    public function hasPermission(Permission $permission)
    {
        return $this->hasRole($permission->roles);
    }
}