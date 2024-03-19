<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateClubRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|unique:t_club',
            'kota' => 'required'

        ];
    }

    public function attributes()
    {
        return [
            'nama' => 'Nama Club',
            'kota' => 'Nota Club'
        ];
    }

    public function messages()
    {
        return [
            'nama.required'               => 'Nama Club harus diisi !',
            'nama.unique'                 => 'Nama Club sudah ada masukan yang lain !',
            'kota.required'               => 'Kota Club harus diisi !',
        ];
    }
}
