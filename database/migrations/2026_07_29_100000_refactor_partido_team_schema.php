<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('partidos', 'equipo_local_nombre')) {
            Schema::table('partidos', function (Blueprint $table) {
                $table->string('equipo_local_nombre')->default('Equipo Azul')->after('fecha_hora');
                $table->string('equipo_visitante_nombre')->default('Equipo Naranja')->after('equipo_local_nombre');
            });
        }

        if (! Schema::hasColumn('asignamientos', 'lado')) {
            Schema::table('asignamientos', function (Blueprint $table) {
                $table->unsignedTinyInteger('lado')->nullable()->after('partido_id');
            });
        }

        if (Schema::hasColumn('partidos', 'equipo1') && Schema::hasColumn('partidos', 'equipo2')) {
            DB::table('partidos')->update([
                'equipo_local_nombre' => 'Equipo Azul',
                'equipo_visitante_nombre' => 'Equipo Naranja',
            ]);
        }

        if (Schema::hasColumn('asignamientos', 'equipo_id') && Schema::hasColumn('partidos', 'equipo1') && Schema::hasColumn('partidos', 'equipo2')) {
            $partidos = DB::table('partidos')->select('id', 'equipo1', 'equipo2')->get();

            foreach ($partidos as $partido) {
                DB::table('asignamientos')
                    ->where('partido_id', $partido->id)
                    ->where('equipo_id', $partido->equipo1)
                    ->update(['lado' => 1]);

                DB::table('asignamientos')
                    ->where('partido_id', $partido->id)
                    ->where('equipo_id', $partido->equipo2)
                    ->update(['lado' => 2]);
            }
        }

        DB::table('asignamientos')->whereNull('lado')->update(['lado' => 1]);
    }

    public function down(): void
    {
        if (Schema::hasColumn('asignamientos', 'lado')) {
            Schema::table('asignamientos', function (Blueprint $table) {
                $table->dropColumn('lado');
            });
        }

        if (Schema::hasColumn('partidos', 'equipo_local_nombre')) {
            Schema::table('partidos', function (Blueprint $table) {
                $table->dropColumn(['equipo_local_nombre', 'equipo_visitante_nombre']);
            });
        }
    }
};
