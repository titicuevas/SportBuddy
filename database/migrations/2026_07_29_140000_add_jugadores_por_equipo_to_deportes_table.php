<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('deportes', 'jugadores_por_equipo')) {
            Schema::table('deportes', function (Blueprint $table) {
                $table->unsignedTinyInteger('jugadores_por_equipo')->default(1)->after('nombre');
            });
        }

        $limites = [
            'Futbol 7' => 7,
            'Futbol Sala' => 5,
            'Padel' => 2,
            'Baloncesto' => 5,
            'Tenis' => 1,
            'Judo' => 1,
        ];

        foreach ($limites as $nombre => $limite) {
            DB::table('deportes')->where('nombre', $nombre)->update([
                'jugadores_por_equipo' => $limite,
            ]);
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('deportes', 'jugadores_por_equipo')) {
            Schema::table('deportes', function (Blueprint $table) {
                $table->dropColumn('jugadores_por_equipo');
            });
        }
    }
};
