<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\AuditingTrait;

class Invite extends Model
{
    use AuditingTrait;
    protected $table = 'invitation';
    public $timestamps = true;

    protected $fillable = [
        'code',
        'email',

        'expiration',
        'active',
        'used',
    ];

    public function object()
    {
        return $this->morphTo();
    }

    public function tournament(){
        return $this->belongsTo('App\Tournament');
    }

    /**
     * Send an email to competitor and generate or update invite
     * @param $email
     * @param $tournament
     * @return String Invitation code | null
     */
    public function generateTournamentInvite($email, $tournament)
    {

        $code = $this->hash_split(hash('sha256', $email)) . $this->hash_split(hash('sha256', time()));

        $invite = Invite::firstOrNew(['email' => $email, 'object_id' => $tournament->id]);
        $invite->code = $code;
        $invite->email = $email;
        $invite->object_type = 'App\Tournament';
        $invite->object_id = $tournament->id;
        $invite->expiration = $tournament->registerDateLimit;
        $invite->active = true;
//        $invite->used = false;

        if ($invite->save())
            return $code;
        else
            return null;

    }


    public function consume()
    {
        // Use the invitation

        $this->update(['used' => 1]);
    }
    public static function getActiveTournamentInvite($token)
    {
        $invite = self::where('code', $token)
            ->where('active', 1)
            ->where('object_type',"App\Tournament")
//            ->where('used', 0)
            ->first();
        return $invite;
    }

    protected function hash_split($hash)
    {
        $output = str_split($hash, 8);
        return $output[rand(0, 1)];
    }

    protected function sql_timestamp()
    {
        return date(DB::connection()->grammar()->grammar->datetime);
    }

}
