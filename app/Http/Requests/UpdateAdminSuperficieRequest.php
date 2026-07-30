<?php

namespace App\Http\Requests;

use App\Rules\UniqueInsensitive;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminSuperficieRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tipo' => [
                'required',
                'string',
                'max:255',
                new UniqueInsensitive('superficies', 'tipo', $this->route('superficie')?->id),
            ],
        ];
    }
}
