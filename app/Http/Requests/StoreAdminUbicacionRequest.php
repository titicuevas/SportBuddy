<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminUbicacionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre'      => ['required', 'string', 'max:255'],
            'direccion'   => ['required', 'string', 'max:255'],
            'enlace_maps' => ['nullable', 'string'],
            'iframe'      => ['nullable', 'string'],
            'imagen'      => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser JPEG, JPG, PNG o WebP.',
            'imagen.max'   => 'La imagen no debe superar los 2 MB.',
        ];
    }
}
