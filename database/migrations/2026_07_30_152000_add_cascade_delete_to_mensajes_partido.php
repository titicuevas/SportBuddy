<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // SQLite no permite alterar FKs; en installs frescos ya está en create_mensajes.
        if (Schema::getConnection()->getDriverName() === 'sqlite') {
            return;
        }

        Schema::table('mensajes', function (Blueprint $table) {
            $table->dropForeign(['partido_id']);
            $table->foreign('partido_id')
                ->references('id')
                ->on('partidos')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        if (Schema::getConnection()->getDriverName() === 'sqlite') {
            return;
        }

        Schema::table('mensajes', function (Blueprint $table) {
            $table->dropForeign(['partido_id']);
            $table->foreign('partido_id')
                ->references('id')
                ->on('partidos');
        });
    }
};
