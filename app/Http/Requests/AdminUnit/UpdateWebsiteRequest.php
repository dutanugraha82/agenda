<?php

namespace App\Http\Requests\AdminUnit;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWebsiteRequest extends FormRequest
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
            'web_category' => 'required',
            'web_url' => 'required|url',
        ];
    }

    public function messages()
    {
        return [
            'web_name.required' => 'Judul kegiatan harus diisi',
            'web_date.required' => 'Tanggal kegiatan harus diisi',
            'web_address.required' => 'URL kegiatan harus diisi',   
            'web_category.required' => 'Kategori kegiatan harus diisi',
            'web_url.required' => 'URL kegiatan harus diisi',
            'web_url.url' => 'URL kegiatan harus berformat link web/http (contoh: https://ubpkarawang.ac.id)',
        ];
    }
}
