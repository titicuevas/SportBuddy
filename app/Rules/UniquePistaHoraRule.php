<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniquePistaHoraRule implements Rule
{
    private $table;
    private $hora;

    public function __construct($table, $hora)
    {
        $this->table = $table;
        $this->hora = $hora;
    }

    public function passes($attribute, $value)
    {
        return !DB::table($this->table)
            ->where('pista_id', $value)
            ->where('hora', $this->hora)
            ->exists();
    }

    public function message()
    {
        return 'La pista ya está reservada a esa hora.';
    }
}
