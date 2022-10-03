<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebsiteRequest extends FormRequest
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
            'web_name' => 'required',
            'web_date' => 'required',
            'web_address' => 'required',
            'web_thumbnail' => 'image',
            'web_document' => 'required',
            'web_type' => 'required',
            'web_category' => 'required',
            'web_url' => 'required',
            'unit_id' => 'required',
            'web_status' => 'required',
            
        ];
    }
}
