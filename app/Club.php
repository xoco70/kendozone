<?php

namespace App;


class Club extends AdministrativeStructure
{

    protected $table = 'club';

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($club) {

//            $club->clubs
            //TODO Unlink all clubs/users from assoc
//            foreach ($tournament->categoryTournaments as $ct) {
//                $ct->delete();
//            }
//            $tournament->invites()->delete();

        });
        static::restoring(function ($club) {

//            foreach ($tournament->categoryTournaments()->withTrashed()->get() as $ct) {
//                $ct->restore();
//            }

        });

    }

    public function association()
    {
        return $this->belongsTo(Association::class);
    }

    public function practicants()
    {
        return $this->hasMany('User');
    }


}