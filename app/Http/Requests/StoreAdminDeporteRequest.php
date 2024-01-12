<?php

namespace App\Http\Requests;

use App\Rules\UniqueInsensitive;
use Illuminate\Foundation\Http\FormRequest;

class StoreAdminDeporteRequest extends FormRequest
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
            'nombre' => ['required', 'string', new UniqueInsensitive('deportes', 'nombre')],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nombre.unique' => 'El deporte ya existe en la base de datos.',
        ];
    }
}
