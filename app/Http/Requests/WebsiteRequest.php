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
            'web_document' => 'mimes:docx',
            'web_type' => 'required',
            'web_category' => 'required',
            'unit_website_id' => 'required',
            
        ];
    }
}
