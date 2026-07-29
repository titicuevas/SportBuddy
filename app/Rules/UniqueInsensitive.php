<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class UniqueInsensitive implements ValidationRule
{
    public function __construct(
        protected string $table,
        protected string $column,
        protected int|string|null $ignoreId = null,
        protected string $idColumn = 'id',
    ) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $query = DB::table($this->table)
            ->whereRaw('LOWER('.$this->column.') = ?', [strtolower((string) $value)]);

        if ($this->ignoreId !== null) {
            $query->where($this->idColumn, '!=', $this->ignoreId);
        }

        if ($query->exists()) {
            $fail('El :attribute ya existe en la base de datos.');
        }
    }
}
