<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\AuditingTrait;

class AdministrativeStructure extends Model
{

    use SoftDeletes;
    use AuditingTrait;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];



    public function president()
    {
        return $this->hasOne(User::class,'id','president_id');
    }
    
}