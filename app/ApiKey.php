<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiKey extends Model
{
    protected $table = 'apiKey';
    public 	$timestamps = false;
    protected $primaryKey = 'id';
}
