<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\AuditingTrait;

class Request extends Model
{
    use AuditingTrait;
    public $timestamps = true;
    protected $table = 'request';
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
