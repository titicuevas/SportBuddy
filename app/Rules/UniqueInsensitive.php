<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueInsensitive implements Rule
{
    protected $table;
    protected $column;

    public function __construct($table, $column)
    {
        $this->table = $table;
        $this->column = $column;
    }

    public function passes($attribute, $value)
    {
        $count = DB::table($this->table)
            ->whereRaw('LOWER(' . $this->column . ') = ?', [strtolower($value)])
            ->count();

        return $count === 0;
    }

    public function message()
    {
        return 'El campo :attribute ya existe en la base de datos.';
    }
}
