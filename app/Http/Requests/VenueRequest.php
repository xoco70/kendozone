<?php

namespace App\Http\Requests;

class VenueRequest extends Request
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
        if ($this->exists('venue_name')) {
            return [
                'venue_name' => 'required',
                'country_id' => 'required|exists:countries,id'
            ];
        }
        return [];
    }
}
