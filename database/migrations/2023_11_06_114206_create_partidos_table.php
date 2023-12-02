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
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Añadido onDelete('cascade')//para borrar los partidos si un usuario lo crea y lo quiere borrar
            $table->foreignId('superficie_id')->constrained();
            $table->foreignId('pista_id')->constrained();
            $table->string('resultado')->nullable();
            $table->foreign('equipo1')->references('id')->on('equipos')->onDelete('cascade');//para borrar los partidos si un usuario lo crea y lo quiere borrar
            $table->foreign('equipo2')->references('id')->on('equipos')->onDelete('cascade');//para borrar los partidos si un usuario lo crea y lo quiere borrar
            $table->foreignId('ubicacion_id')->constrained('ubicaciones')->onDelete('cascade'); // Añadido onDelete('cascade') , para borrar los partidos si un usuario lo crea y lo quiere borrar
            $table->foreignId('deporte_id')->constrained()->onDelete('cascade'); // Añadido onDelete('cascade')//para borrar los partidos si un usuario lo crea y lo quiere borrar
            $table->decimal('precio', 8, 2)->nullable();


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
