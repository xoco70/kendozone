<?php

namespace App;

use Illuminate\Support\Facades\Auth;

class Competitor extends \Xoco70\LaravelTournaments\Models\Competitor
{
    public static function getShortId($categories, Tournament $tournament)
    {
        $competitor = static::where('user_id', Auth::user()->id)
            ->whereIn('championship_id', $categories)->first();

        if ($competitor != null) {
            return $competitor->short_id;
        }
        return $tournament->competitors()->max('short_id') + 1;
    }

    /**
     * @param $attributes
     * @return mixed $user
     */
    public static function createUser($attributes)
    {
        $user = User::where(['email' => $attributes['email']])->withTrashed()->first();

        if ($user == null) {
            $password = str_random(8);
            $user = User::create([
                'firstname' => $attributes['firstname'],
                'lastname' => $attributes['lastname'],
                'name' => $attributes['name'],
                'email' => $attributes['email']
            ]);
            $user->clearPassword = $password;
        }
        // If user is deleted, this is restoring the user only, but not his asset ( tournaments, categories, etc.)
        if ($user->isDeleted()) {
            $user->deleted_at = null;
            $user->save();
        }
        return $user;
    }
}
