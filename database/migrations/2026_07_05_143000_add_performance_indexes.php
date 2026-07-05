<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('partidos', function (Blueprint $table) {
            $table->index('fecha_hora', 'partidos_fecha_hora_index');
            $table->unique(['pista_id', 'fecha_hora'], 'partidos_pista_fecha_hora_unique');
        });

        Schema::table('asignamientos', function (Blueprint $table) {
            $table->unique(['partido_id', 'user_id'], 'asignamientos_partido_user_unique');
        });

        Schema::table('comentarios', function (Blueprint $table) {
            $table->index(['partido_id', 'created_at'], 'comentarios_partido_created_index');
        });

        Schema::table('mensajes', function (Blueprint $table) {
            $table->index(['partido_id', 'created_at'], 'mensajes_partido_created_index');
        });

        Schema::table('pistas', function (Blueprint $table) {
            $table->index(['ubicacion_id', 'deporte_id'], 'pistas_ubicacion_deporte_index');
        });
    }

    public function down(): void
    {
        Schema::table('partidos', function (Blueprint $table) {
            $table->dropIndex('partidos_fecha_hora_index');
            $table->dropUnique('partidos_pista_fecha_hora_unique');
        });

        Schema::table('asignamientos', function (Blueprint $table) {
            $table->dropUnique('asignamientos_partido_user_unique');
        });

        Schema::table('comentarios', function (Blueprint $table) {
            $table->dropIndex('comentarios_partido_created_index');
        });

        Schema::table('mensajes', function (Blueprint $table) {
            $table->dropIndex('mensajes_partido_created_index');
        });

        Schema::table('pistas', function (Blueprint $table) {
            $table->dropIndex('pistas_ubicacion_deporte_index');
        });
    }
};
