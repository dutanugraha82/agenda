<?php

namespace App\Http\Requests\AdminUnit;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSocialMediaRequest extends FormRequest
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
            'socmed_name' => 'required',
            'socmed_date' => 'required',
            'socmed_address' => 'required',
            'category' => 'required',
            'socmed_url' => 'required|url',
        ];
    }

    public function messages()
    {
        return [
            'socmed_name.required' => 'Judul kegiatan harus diisi',
            'socmed_date.required' => 'Tanggal kegiatan harus diisi',
            'socmed_address.required' => 'Tempat kegiatan harus diisi',   
            'category.required' => 'Kategori kegiatan harus diisi',
            'socmed_url.required' => 'URL social media harus diisi',
            'socmed_url.url' => 'URL social media harus berformat link web/http (contoh: https://ubpkarawang.ac.id)',
        ];
    }
}
