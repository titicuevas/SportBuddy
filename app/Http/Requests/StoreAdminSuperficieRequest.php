<?php

namespace App\Http\Requests;

use App\Rules\UniqueInsensitive;
use Illuminate\Foundation\Http\FormRequest;

class StoreAdminSuperficieRequest extends FormRequest
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
            'tipo' => ['required', 'string', new UniqueInsensitive('superficies', 'tipo')],
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
            'tipo.unique' => 'El tipo ya existe en la base de datos.',
        ];
    }
}
