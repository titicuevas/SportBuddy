<?php

namespace App\Http\Requests;

use App\Rules\UniqueInsensitive;
use Illuminate\Foundation\Http\FormRequest;

class StoreAdminDeporteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:255', new UniqueInsensitive('deportes', 'nombre')],
            'jugadores_por_equipo' => ['required', 'integer', 'min:1', 'max:30'],
        ];
    }
}
