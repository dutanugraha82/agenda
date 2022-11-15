<?php

namespace App\Http\Requests\SuperAdmin;

use Illuminate\Foundation\Http\FormRequest;

class StoreUnitRequest extends FormRequest
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
            'unit_name' => 'required',
            'url' => 'required|url',
        ];
    }

    public function messages(){
        return [
            'unit_name.required' => 'Nama unit harus diisi',
            'url.required' => 'URL harus diisi',
            'url.url' => 'URL hrus berformat url/http (contoh: https://ubpkarawang.ac.id)',
        ];
    }
}
