<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver !== 'sqlite' && Schema::hasTable('partidos')) {
            DB::statement('ALTER TABLE partidos DROP CONSTRAINT IF EXISTS partidos_equipo1_foreign');
            DB::statement('ALTER TABLE partidos DROP CONSTRAINT IF EXISTS partidos_equipo2_foreign');
        }

        if (Schema::hasTable('partidos') && Schema::hasColumn('partidos', 'equipo1')) {
            Schema::table('partidos', function (Blueprint $table) {
                $table->dropColumn(['equipo1', 'equipo2']);
            });
        }

        if ($driver !== 'sqlite' && Schema::hasTable('asignamientos')) {
            DB::statement('ALTER TABLE asignamientos DROP CONSTRAINT IF EXISTS asignamientos_equipo_id_foreign');
        }

        if (Schema::hasTable('asignamientos') && Schema::hasColumn('asignamientos', 'equipo_id')) {
            Schema::table('asignamientos', function (Blueprint $table) {
                $table->dropColumn('equipo_id');
            });
        }

        if (Schema::hasTable('equipos') && ! Schema::hasColumn('partidos', 'equipo1') && ! Schema::hasColumn('asignamientos', 'equipo_id')) {
            Schema::dropIfExists('equipos');
        }
    }

    public function down(): void
    {
        //
    }
};
