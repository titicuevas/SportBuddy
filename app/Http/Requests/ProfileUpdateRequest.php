<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'regex:/^\d{9}$/'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Introduce tu nombre.',
            'apellidos.required' => 'Introduce tus apellidos.',
            'telefono.required' => 'Introduce tu teléfono.',
            'telefono.regex' => 'El teléfono debe tener exactamente 9 dígitos.',
            'email.required' => 'Introduce tu correo electrónico.',
            'email.email' => 'El correo electrónico no tiene un formato válido.',
            'email.unique' => 'Ese correo electrónico ya está en uso.',
        ];
    }
}
