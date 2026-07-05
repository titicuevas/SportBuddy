<?php

namespace App\Rules;

use App\Models\Partido;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniquePistaHoraRule implements ValidationRule
{
    public function __construct(
        protected string $hora,
        protected int|string $pistaId
    ) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $fechaHora = Carbon::parse($value.' '.$this->hora);

        $exists = Partido::where('pista_id', $this->pistaId)
            ->where('fecha_hora', $fechaHora)
            ->exists();

        if ($exists) {
            $fail('Ya hay un partido programado en la misma hora, mismo día y misma pista.');
        }
    }
}
