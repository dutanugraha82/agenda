<?php

namespace App\Http\Requests\SuperAdmin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class StoreSocialMediaRequest extends FormRequest
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
            'unit_id' => 'required',
            'account_name' => 'required',
            'social_media' => 'required',
            'url' => 'required|url'
        ];
    }

    public function messages(){
        return [
            'account_name.required' => 'Akun sosial media harus diisi',
            'social_media.required' => 'Platform sosial media harus diisi',
            'url.required' => 'URL/link sosial media harus diisi',
            'url.url' => 'URL/link sosial media harus berformat link/http',
        ];
    }
}
