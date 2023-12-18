<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Partido;
use Carbon\Carbon;

class UniquePistaHoraRule implements Rule
{
    protected $table;
    protected $hora;
    protected $pistaId;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($table, $hora, $pistaId)
    {
        $this->table = $table;
        $this->hora = $hora;
        $this->pistaId = $pistaId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Obtener la fecha y hora seleccionadas por el usuario
        $fechaHoraSeleccionada = Carbon::parse($value . ' ' . $this->hora);

        // Verificar si hay algún partido existente en la misma hora, mismo día y misma pista
        return !Partido::where('pista_id', $this->pistaId)
            ->where('fecha_hora', '>=', $fechaHoraSeleccionada)
            ->where('fecha_hora', '<', $fechaHoraSeleccionada->copy()->addHour()) // Asegurar que no haya superposición exacta
            ->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Ya hay un partido programado en la misma hora, mismo día y misma pista.';
    }
}
