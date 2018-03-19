<?php

namespace App;

use App\Notifications\InviteCompetitor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use OwenIt\Auditing\Contracts\Auditable;


class Invite extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    public $timestamps = true;
    protected $table = 'invitation';
    protected $fillable = [
        'code',
        'email',

        'expiration',
        'active',
        'used',
    ];

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

    public static function sendInvites($reader, $tournament)
    {
        $reader->each(function ($sheet) use ($tournament) {
            // Loop through all rows of spreadsheet
            $sheet->each(function ($row) use ($tournament) {
                // Check email
                $invite = new Invite();
                $code = $invite->generateTournamentInvite($row, $tournament);
                $user = new User();
                $user->email = $row;
                $user->notify(new InviteCompetitor($user, $tournament, $code));
            });
        });
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

        return null;
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
     * Consume the invitation
     */
    public function consume()
    {
        // Use the invitation
        $this->update(['used' => 1]);
    }

    public function hasExpired()
    {
        return $this->expiration < Carbon::now() && $this->expiration != '0000-00-00';
    }

    /**
     * @param $reader
     * @param $tournament
     */
    public function checkBadEmailsInExcel($reader, $tournament)
    {
        $reader->each(function ($sheet) use ($tournament) {
            // Loop through all rows
            $sheet->each(function ($row) use ($tournament) {
                // Check email
                if (!filter_var($row, FILTER_VALIDATE_EMAIL)) {
                    $this->emailBadFormat = true;
                    $this->wrongEmail = $row;
                }
            });
        });
    }

}
