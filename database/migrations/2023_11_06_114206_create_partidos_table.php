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
            $table->timestamp('fecha_hora')->nullable();
            $table->bigInteger('equipo1');
            $table->bigInteger('equipo2');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('superficie_id')->constrained();
            $table->foreignId('pista_id')->constrained();
            $table->string('resultado')->nullable();
            $table->foreign('equipo1')->references('id')->on('equipos')->onDelete('cascade');
            $table->foreign('equipo2')->references('id')->on('equipos')->onDelete('cascade');
            $table->foreignId('ubicacion_id')->constrained('ubicaciones')->onDelete('cascade');
            $table->foreignId('deporte_id')->constrained()->onDelete('cascade');
            $table->decimal('precio', 8, 2)->nullable();
            $table->boolean('pista_tiene_luz')->default(false);
            $table->decimal('precio_con_luz', 8, 2)->nullable();
            $table->boolean('pago_aprobado')->default(false); //Agregada 26-02-2024
            $table->timestamps();
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
