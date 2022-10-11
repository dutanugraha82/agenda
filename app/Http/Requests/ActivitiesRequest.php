<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivitiesRequest extends FormRequest
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
            'act_name' => 'required',
            'act_date' => 'required',
            'act_address' => 'required',
            'partisipant' => 'required',
            'type' => 'required',
            'unit_id' => 'required',
            'act_status' => 'required'
        ];
    }
}
