<?php

namespace App;

class Association extends AdministrativeStructure
{

    protected $table = 'association';


    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($association) {

//            $association->clubs
            //TODO Unlink all clubs/users from assoc
//            foreach ($tournament->categoryTournaments as $ct) {
//                $ct->delete();
//            }
//            $tournament->invites()->delete();

        });
        static::restoring(function ($tournament) {

//            foreach ($tournament->categoryTournaments()->withTrashed()->get() as $ct) {
//                $ct->restore();
//            }

        });

    }

    public function federation()
    {
        return $this->belongsTo(Federation::class);
    }

    public function clubs()
    {
        return $this->hasMany('Club');
    }


}