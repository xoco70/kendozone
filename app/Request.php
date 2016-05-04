<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\AuditingTrait;

class Request extends Model
{
    use AuditingTrait;
    protected $table = 'request';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'object_type',
        'object_id',
        'used',
    ];

    public function object()
    {
        return $this->morphTo();
    }


    public function consume()
    {
        // Consume the request

        $this->update(['used' => 1]);
    }

}
