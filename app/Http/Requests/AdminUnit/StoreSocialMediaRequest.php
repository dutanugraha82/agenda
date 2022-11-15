<?php

namespace App\Http\Requests\AdminUnit;

use Illuminate\Foundation\Http\FormRequest;

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
            'socmed_name' => 'required',
            'socmed_date' => 'required',
            'socmed_address' => 'required',
            'caption' => 'required|mimes:pdf',
            'thumbnail' => 'required',
            'category' => 'required',
            // 'socmed_url.*' => 'url'
        ];
    }

    public function messages(){
        return [
            'socmed_name.required' => 'Nama kegiatan harus diisi',
            'socmed_date.required' => 'Tanggal kegiatan harus diisi',
            'socmed_address.required' => 'Alamat kegiatan harus diisi',
            'caption.required' => 'Naskah sosial media harus diisi',
            'caption.mimes' => 'Naskah sosial media harus berformat pdf',
            'thumbnail.required' => 'Bukti gambar harus diisi',
            'category.required' => 'Kategori harus diisi',
            // 'socmed_url.required' => 'URL sosial media harus diisi',
            // 'socmed_url.url' => 'URL sosial media harus berformat url/http',
        ];
    }
}
