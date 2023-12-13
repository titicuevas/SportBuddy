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
        Schema::create('pistas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ubicacion_id')->constrained('ubicaciones');
            $table->foreignId('superficie_id')->constrained();
            $table->foreignId('deporte_id')->constrained('deportes');
            $table->integer('numero');
            $table->boolean('tiene_luz')->default(false); // Columna para indicar si la pista tiene luz
            $table->decimal('precio_con_luz', 8, 2)->nullable(); // Columna para el precio con luz, puede ser NULL si no aplica
            $table->decimal('precio_sin_luz', 8, 2); // Precio sin luz
            $table->json('horas_disponibles')->nullable(); // Nuevas horas disponibles

            // Puedes agregar otras columnas según sea necesario

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pistas');
    }
};
