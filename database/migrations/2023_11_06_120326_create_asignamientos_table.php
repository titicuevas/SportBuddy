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
        Schema::create('asignamientos', function (Blueprint $table) {
            $table->foreignId('partido_id')->constrained();
            $table->foreignId('equipo_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->primary(['partido_id', 'equipo_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignamiento');
    }
};
