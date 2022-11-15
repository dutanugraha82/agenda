<?php

namespace App\Http\Requests\AdminUnit;

use Illuminate\Foundation\Http\FormRequest;

class StoreActivityRequest extends FormRequest
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
            'act_address' => 'required',
            'act_date' => 'required',
            'partisipant' => 'required|numeric',
            'type' => 'required',
            'category' => 'required'
        ];
    }

    public function messages(){
        return [
            'act_name.required' => 'Nama agenda kegiatan harus diisi',
            'act_address.required' => 'Tempat/alamat agenda kegiatan harus diisi',
            'act_date.required' => 'Tanggal agenda kegiatan harus diisi',
            'partisipant.required' => 'Jumlah perkiraan partisipan harus diisi',
            'partisipant.numeric' => 'Jumlah perkiraan partisipan harus berformat angka',
            'type.required' => 'Jenis agenda kegiatan harus diisi',
            'type.required' => 'Kategori agenda kegiatan harus diisi',
        ];
    }
}
