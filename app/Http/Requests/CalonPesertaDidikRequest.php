<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalonPesertaDidikRequest extends FormRequest
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
            'nisn' => 'required',
            'nilai_nhun' => 'required',
            'alamat' => 'required'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nisn.required' => 'NISN perlu diisi!',
            'nilai_nhun.required' => 'NHUN perlu diisi!',
            'alamat.required' => 'Alamat perlu diisi!'
        ];
    }
}
