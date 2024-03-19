<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePertandinganRequest extends FormRequest
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
            'id_club_1' => 'required',
            'id_club_2' => 'required',
            'skor_club_1' => 'required',
            'skor_club_2' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'id_club_1' => 'Klub Pertama',
            'id_club_2' => 'Klub Kedua',
            'skor_club_1' => 'SKor Klub Pertama',
            'skor_club_2' => 'Skor Klub Kedua'
        ];
    }

    public function messages()
    {
        return [
            'id_club_1.required' => 'Klub Pertama Harus Diisi!',
            'id_club_2.required' => 'Klub Kedua Harus Diisi ',
            'skor_club_1.required' => 'SKor Klub Pertama Harus Diisi',
            'skor_club_2.required' => 'Skor Klub Kedua Harus Diisi'
        ];
    }
}
