<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
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

    /**
     * Verify if it is in use
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tournament()
    {
        return $this->belongsTo('App\Tournament');
    }

    /**
     * Send an email to competitor and generate or update invite
     * @param $email
     * @param $tournament
     * @return String Invitation code | null
     */
    public function generateTournamentInvite($email, Tournament $tournament)
    {
        $token = $this->hash_split(hash('sha256', $email)) . $this->hash_split(hash('sha256', time()));
        $invite = Invite::firstOrNew(['email' => $email, 'object_type' => 'App\Tournament', 'object_id' => $tournament->id]);
        $invite->code = $token;
        $invite->email = $email;
        $invite->object_type = 'App\Tournament';
        $invite->object_id = $tournament->id;
        $invite->expiration = $tournament->registerDateLimit;
        $invite->active = true;

        if ($invite->save())
            return $token;
        else
            return null;
    }

    /**
     * Consume the invitation
     */
    public function consume()
    {
        // Use the invitation
        $this->update(['used' => 1]);
    }


    /**
     * Get invite from Token
     * @param $token
     * @return Invite
     */
    public static function getInviteFromToken($token)
    {
        $invite = self::where('code', $token)
            ->where('active', 1)
            ->where('object_type', "App\Tournament")
            ->first();
        return $invite;
    }

    /**
     * @param $tournament
     */
    public function saveItem($tournament)
    {
        $invite = new Invite();
        $invite->code = 'open';
        $invite->email = Auth::user()->email;
        $invite->object_type = 'App\Tournament';
        $invite->object_id = $tournament->id;
        $invite->active = 1;
        $invite->used = 1;
        $invite->save();

    }


    /**
     * Helper used to hash email into token
     * @param $hash
     * @return mixed
     */
    protected function hash_split($hash)
    {
        $output = str_split($hash, 8);
        return $output[rand(0, 1)];
    }
    public function hasExpired(){
        return $this->expiration < Carbon::now() && $this->expiration != '0000-00-00';
    }

}
