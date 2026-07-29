<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAdminPistaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ubicacion_id' => ['required', 'exists:ubicaciones,id'],
            'superficie_id' => ['required', 'exists:superficies,id'],
            'deporte_id'    => ['required', 'exists:deportes,id'],
            'numero'        => [
                'required',
                'integer',
                'min:0',
                Rule::unique('pistas')
                    ->where('ubicacion_id', $this->ubicacion_id)
                    ->where('superficie_id', $this->superficie_id)
                    ->where('deporte_id', $this->deporte_id),
            ],
            'precio_sin_luz' => ['required', 'numeric', 'min:0'],
            'precio_con_luz' => ['nullable', 'numeric', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'numero.unique' => 'El número de pista ya está en uso para esta ubicación, superficie y deporte.',
        ];
    }
}
