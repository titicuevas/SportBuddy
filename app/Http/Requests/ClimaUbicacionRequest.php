<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClimaUbicacionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fecha' => ['nullable', 'date'],
            'hora' => ['nullable', 'date_format:H:i'],
        ];
    }

    public function messages(): array
    {
        return [
            'fecha.date' => 'La fecha no es válida.',
            'hora.date_format' => 'La hora debe tener el formato HH:MM.',
        ];
    }
}
