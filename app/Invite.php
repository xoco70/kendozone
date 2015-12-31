<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Invite extends Model
{
    protected $table = 'invitation';
    public $timestamps = true;

    protected $fillable = [
        'code',
        'email',
        'expiration',
        'active',
//        'used',
    ];

    public function tournament(){
        return $this->belongsTo('App\Tournament');
    }

    public function generate($email, $tournament)
    {

        $code = $this->hash_split(hash('sha256', $email)) . $this->hash_split(hash('sha256', time()));
        $invite = new Invite();
        $invite->code = $code;
        $invite->email = $email;
        $invite->tournament_id = $tournament->id;
        $invite->expiration = $tournament->registerDateLimit;
        $invite->active = true;
//        $invite->used = false;

        if ($invite->save())
            return $code;
        else
            return null;

    }
    /**
     * @param $tournament
     * @param $user
     * @param $invite
     */
//    public function consume()
//    {
//// User exists, just add it to tournament
//        // And update invite
//        $user = User::where('email', $this->email)->first();
//
////        dd($this->tournament);
////
//        if (!$this->tournament->competitors->contains($user->id)) {
//            $this->tournament->competitors()->attach($user->id);
//        }
//        // Use the invitation
//        $this->update(['used' => 1]);
//    }
    public static function getActiveInvite($token)
    {
        $invite = Invite::where('code', $token)
            ->where('active', 1)
//            ->where('used', 0)
            ->first();
        return $invite;
    }

//    public function active($code, $email)
//    {
//        DB::connection()
//            ->table('invitation')
//            ->where('code', '=', $code)->where('email', '=', $email)
//            ->update(array('active' => True));
//    }
//
//    public function deactive($code, $email)
//    {
//        DB::connection()
//            ->table('invitation')
//            ->where('code', '=', $code)->where('email', '=', $email)
//            ->update(array('active' => False));
//    }

//    public function used($code, $email)
//    {
//        DB::connection()
//            ->table('invitation')
//            ->where('code', '=', $code)->where('email', '=', $email)
//            ->update(array('used' => True));
//    }
//
//    public function unuse($code, $email)
//    {
//        DB::connection()
//            ->table('invitation')
//            ->where('code', '=', $code)->where('email', '=', $email)
//            ->update(array('used' => False));
//    }

//    public function status($code, $email)
//    {
//        $temp = DB::connection()
//            ->table('invitation')
//            ->where('code', '=', $code)
//            ->where('email', '=', $email)
//            ->first();
//        if ($temp) {
//            if (!$temp->active)
//                return "deactive";
//            else if ($temp->used)
//                return "used";
//            else if ($this->sql_timestamp() > $temp->expiration)
//                return "expired";
//            else
//                return "valid";
//        } else
//            return "not exist";
//    }

//    public function check($code, $email)
//    {
//        $temp = DB::connection()
//            ->table('invitation')
//            ->where('code', '=', $code)->where('email', '=', $email)
//            ->first();
//        if ($temp) {
//            if (!$temp->active or $temp->used or $this->sql_timestamp() > $temp->expiration)
//                return False;
//            else
//                return True;
//        } else
//            return False;
//    }
//    public function delete($code,$email)
//    {
//        $temp = DB::connection()
//            ->table('invitation')
//            ->where('code', '=', $code)->where('email','=',$email)
//            ->delete();
//    }
//    protected function checkEmail($email, $tournament)
//    {
//        $temp = DB::connection()
//            ->table('invitation')
//            ->where('email', '=', $email)
//            ->and('tournament_id', " = ", $tournament->id)
//            ->and('used','=', 1)
//            ->first();
//        if($temp)
//            return False;
//        else
//            return True;
//    }
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
