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
        return $this->belongsTo(Role::class,'id');
    }
    /**
     * Assign the given role to the user.
     *
     * @param  string $role
     * @return mixed
     */
//	public function assignRole($role)
//	{
//        $this->roleId = $role->id;
//        return $this->save();
//
////		return $this->roles()->save(
////				Role::whereName($role)->firstOrFail()
////		);
//	}
    /**
     * Determine if the user has the given role.
     *
     * @param  mixed $role
     * @return boolean
     */
    public function hasRole($role)
    {
        //	public function hasRole($role)
        {
            if (is_string($role)) {
                return $this->role->equals('name', $role);
            }
            return $role->contains($this->role);



        }
    }

    /**
     * Determine if the user may perform    the given permission.
     *
     * @param  Permission $permission
     * @return boolean
     */
    public function hasPermission(Permission $permission)
    {
//        echo($permission);
        return $this->hasRole($permission->roles);
    }
}