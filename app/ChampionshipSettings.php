<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\AuditingTrait;

class ChampionshipSettings extends Model
{
    use SoftDeletes;
    use AuditingTrait;
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $table = 'championship_settings';
    public $timestamps = true;
    protected $guarded = ['id'];

    public function championship()
    {
        return $this->belongsTo(Championship::class);
    }
}
