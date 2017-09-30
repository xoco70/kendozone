<?php

namespace App\Http\Requests;

use App\Invite;
use App\Tournament;
use Illuminate\Support\Facades\Auth;

class ChampionshipRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        ];
    }

    public function getInvite(Tournament $tournament)
    {
        if ($this->invite != 0)
            return Invite::findOrFail($this->invite);

        return Invite::where('code', 'open')
            ->where('email', Auth::user()->email)
            ->where('object_type', 'App\Tournament')
            ->where('object_id', $tournament->id)
            ->get();
    }
}
