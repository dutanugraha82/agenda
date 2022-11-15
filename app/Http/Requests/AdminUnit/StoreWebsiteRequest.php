<?php

namespace App\Http\Requests\AdminUnit;

use Illuminate\Foundation\Http\FormRequest;

class StoreWebsiteRequest extends FormRequest
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
            'web_document' => 'required|mimes:pdf',
            'web_category' => 'required',
            'web_thumbnail' => 'required',
            'web_url' => 'required|url',
        ];
    }

    public function messages()
    {
        return [
            'web_name.required' => 'Judul artikel harus diisi',
            'web_date.required' => 'Tanggal publikasi artikel harus diisi',
            'web_address.required' => 'URL artikel harus diisi',
            'web_document.required' => 'Naskah artikel/berita harus diisi',
            'web_document.mimes' => 'Naskah artikel/berita harus format PDF',
            'web_category.required' => 'Kategori artikel harus diisi',
            'web_thumbnail.required' => 'Bukti gambar artikel harus diisi',
            'web_url.required' => 'URL artikel harus diisi',
            'web_url.url' => 'URL artikel harus berformat link web/http (contoh: https://ubpkarawang.ac.id)',
        ];
    }
}
