<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = ['name', 'label'];

    /**
     * A role may be given various permissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Grant the given permission to a role.
     *
     * @param $query
     * @param $userType
     * @return mixed
     */
    public function scopeGrantedRoles($query, $userType)
    {
        return $query->where('id', '>=', $userType);
    }
}