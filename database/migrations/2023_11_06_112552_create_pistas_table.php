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
            $table->integer('numero');

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
