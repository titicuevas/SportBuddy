<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('partidos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->time('hora');
            $table->bigInteger('equipo1');
            $table->bigInteger('equipo2');
            $table->foreignId('user_id')->constrained();
            $table->string('resultado')->nullable();
            $table->foreign('equipo1')->references('id')->on('equipos')->onDelete('cascade');
            $table->foreign('equipo2')->references('id')->on('equipos')->onDelete('cascade');
            $table->foreignId('ubicacion_id')->constrained('ubicaciones');
            $table->foreignId('deporte_id')->constrained();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partidos');

    }

};
