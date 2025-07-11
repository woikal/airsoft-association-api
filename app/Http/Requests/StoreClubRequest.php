<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClubRequest extends FormRequest
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
            'name'         => 'required',
            'abbreviation' => 'string',
            'club_id'      => 'required, integer',
            'location'     => '',
            'founded_at'   => 'greater:2000',
            'website'      => '',
            'facebook'     => '',
            'instagram'    => '',
            'email'        => '',
        ];
    }
}
