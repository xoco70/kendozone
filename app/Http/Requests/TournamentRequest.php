<?php

namespace App\Http\Requests;

use App\Tournament;
use App\Venue;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TournamentRequest extends Request
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
        switch (true) {

            case $this->exists('dateIni'):
                return [
                    'name' => 'required|min:6',
                    'dateIni' => 'required|date',
                    'dateFin' => 'required|date',
                ];
            case $this->exists('longitude'):
                return [
                    'venue_name' => 'required|min:3'
                ];
            case $this->has('category'):
                return [
                    'category' => 'required'
                ];

            case $this->rule_id == 0:
                return [
                    'name' => 'required|min:6',
                    'dateIni' => 'required|date',
                    'dateFin' => 'required|date',
                    'category' => 'required',
                ];
            default:
                return [
                    'name' => 'required|min:6',
                    'dateIni' => 'required|date',
                    'dateFin' => 'required|date',
                ];

        }


    }

    /**
     * @return Tournament $tournament
     */
    public function persist()
    {
        $request = $this->except('category', 'config');
        $request['registerDateLimit'] = Carbon::now()->addMonth(3);

        $tournament = Auth::user()->tournaments()->create($request);
        if ($this->rule_id == 0) {
            $tournament->categories()->sync($this->input('category'));
            return $tournament;
        }
        $tournament->setAndConfigureCategories($this->rule_id);
        return $tournament;
    }

    /**
     * @param Tournament $tournament
     * @return array
     */
    public function update(Tournament $tournament, Venue $venue)
    {
        $res = null;
        switch (true) {
            case $this->exists('dateIni'):
                $res = $tournament->update($this->all());
                break;
            case $this->exists('longitude'):
                $tournament->venue_id = $venue->id;
                $tournament->update();
                $res = true;
                break;
            case $this->has('category'):
                $res = $tournament->categories()->sync($this->input('category'));
                break;
            default:
                $tournament->setAndConfigureCategories($this->rule_id);
                $res = $tournament->update($this->all());
                break;
        }
        return $res;
    }
}
