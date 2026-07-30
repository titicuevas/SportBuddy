<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('pistas')
            ->whereNotNull('precio_con_luz')
            ->update(['tiene_luz' => true]);

        DB::table('pistas')
            ->whereNull('precio_con_luz')
            ->update(['tiene_luz' => false]);
    }

    public function down(): void
    {
        //
    }
};
