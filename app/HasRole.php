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
        return $this->belongsTo(Role::class,'roleId', 'id');
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

        if (is_string($role)) {
            return $this->role->equals('name', $role);
        }

//        dd($role->contains($this->role->name));

//        var_dump($role->contains($this->role->name));
//        echo "<br/>hasRole<br/>";
//        var_dump($role);
//        echo"<br>";
//        var_dump($this->role->name);
//        echo"<br>";
        // Convert array to collection
//        $role = collect($role);

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
//        echo($permission->name);
//        echo $permission->name." hasPermission";
//        var_dump($this->hasRole($permission->roles));
        return $this->hasRole($permission->roles);
    }
}