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
        'used',
    ];


    public function generate($email,$expire,$active)
    {
        if($this->checkEmail($email))
        {
            $now = strtotime($this->sql_timestamp());
            $format = 'Y-m-d H:i:s ';
            $expiration = date($format, strtotime('+ '.$expire, $now));
            $code = $this->hash_split(hash('sha256',$email)) . $this->hash_split(hash('sha256',time()));
            $newInvi = array(
                "code"	=> $code,
                "email"	=> $email,
                "expiration"	=> $expiration,
                "active"	=> $active,
                "used"	=> "0",
                "created_at"	=> $this->sql_timestamp(),
                "updated_at"	=> $this->sql_timestamp(),
            );
            DB::connection()
                ->table('invitation')
                ->insert($newInvi);
            return json_encode($newInvi);
        }
        else
        {
            return "This email address has an invitation.";
        }

    }


    public function active($code,$email)
    {
        DB::connection()
            ->table('invitation')
            ->where('code','=',$code)->where('email','=',$email)
            ->update(array('active'=>True));
    }
    public function deactive($code,$email)
    {
        DB::connection()
            ->table('invitation')
            ->where('code','=',$code)->where('email','=',$email)
            ->update(array('active'=>False));
    }
    public function used($code,$email)
    {
        DB::connection()
            ->table('invitation')
            ->where('code','=',$code)->where('email','=',$email)
            ->update(array('used'=>True));
    }
    public function unuse($code,$email)
    {
        DB::connection()
            ->table('invitation')
            ->where('code','=',$code)->where('email','=',$email)
            ->update(array('used'=>False));
    }
    public function status($code,$email)
    {
        $temp = DB::connection()
            ->table('invitation')
            ->where('code', '=', $code)->where('email','=',$email)
            ->first();
        if($temp)
        {
            if(!$temp->active)
                return "deactive";
            else if($temp->used)
                return "used";
            else if($this->sql_timestamp() > $temp->expiration)
                return "expired";
            else
                return "valid";
        }
        else
            return "not exist";
    }
    public function check($code,$email)
    {
        $temp = DB::connection()
            ->table('invitation')
            ->where('code', '=', $code)->where('email','=',$email)
            ->first();
        if($temp)
        {
            if(!$temp->active or $temp->used or $this->sql_timestamp() > $temp->expiration)
                return False;
            else
                return True;
        }
        else
            return False;
    }
    public function delete($code,$email)
    {
        $temp = DB::connection()
            ->table('invitation')
            ->where('code', '=', $code)->where('email','=',$email)
            ->delete();
    }
    protected function checkEmail($email)
    {
        $temp = DB::connection()
            ->table('invitation')
            ->where('email', '=', $email)
            ->first();
        if($temp)
            return False;
        else
            return True;
    }
    protected function hash_split($hash)
    {
        $output = str_split($hash,8);
        return $output[rand(0,1)];
    }
    protected function sql_timestamp()
    {
        return date(DB::connection()->grammar()->grammar->datetime);
    }

}
