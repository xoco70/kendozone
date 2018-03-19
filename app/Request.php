<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\AuditingTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Request extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
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
