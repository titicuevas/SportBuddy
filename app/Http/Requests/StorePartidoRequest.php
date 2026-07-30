<?php

namespace App\Http\Requests;

use App\Models\Pista;
use App\Rules\UniquePistaHoraRule;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StorePartidoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fecha' => ['required', 'date', 'after_or_equal:today', new UniquePistaHoraRule($this->input('hora'), $this->input('pista_id'))],
            'hora' => ['required', 'date_format:H:i'],
            'ubicacion_id' => ['required', 'exists:ubicaciones,id'],
            'deporte' => ['required', 'exists:deportes,nombre'],
            'pista_id' => ['required', 'exists:pistas,id'],
            'precio' => ['required', 'numeric', 'min:0'],
            'tipo_superficie' => ['required', 'exists:superficies,tipo'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            if ($validator->errors()->isNotEmpty()) {
                return;
            }

            $pista = Pista::with(['deporte:id,nombre', 'superficie:id,tipo'])->find($this->input('pista_id'));

            if (! $pista) {
                return;
            }

            if ((int) $pista->ubicacion_id !== (int) $this->input('ubicacion_id')) {
                $validator->errors()->add('pista_id', 'La pista no pertenece a la ubicación seleccionada.');
            }

            if ($pista->deporte?->nombre !== $this->input('deporte')) {
                $validator->errors()->add('deporte', 'El deporte no coincide con el de la pista seleccionada.');
            }

            if ($pista->superficie?->tipo !== $this->input('tipo_superficie')) {
                $validator->errors()->add('tipo_superficie', 'La superficie no coincide con la de la pista seleccionada.');
            }

            $preciosPermitidos = collect([
                $pista->precio_sin_luz,
                $pista->precio_con_luz,
            ])->filter(fn ($precio) => $precio !== null)
                ->map(fn ($precio) => number_format((float) $precio, 2, '.', ''))
                ->unique()
                ->values();

            $precioEnviado = number_format((float) $this->input('precio'), 2, '.', '');

            if (! $preciosPermitidos->contains($precioEnviado)) {
                $validator->errors()->add('precio', 'El precio no coincide con las tarifas de la pista.');
            }

            $fechaHora = Carbon::parse($this->input('fecha').' '.$this->input('hora'));

            if ($fechaHora->lessThanOrEqualTo(now())) {
                $validator->errors()->add('hora', 'La hora seleccionada debe ser posterior a la hora actual.');
            }
        });
    }
}
