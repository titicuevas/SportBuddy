<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateFotoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'foto' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
            'foto_eliminada' => ['nullable', 'in:0,1'],
        ];
    }

    public function messages(): array
    {
        return [
            'foto.image' => 'El archivo debe ser una imagen.',
            'foto.mimes' => 'La foto debe ser JPEG, PNG o WebP.',
            'foto.max' => 'La foto no puede superar los 2 MB.',
        ];
    }
}
