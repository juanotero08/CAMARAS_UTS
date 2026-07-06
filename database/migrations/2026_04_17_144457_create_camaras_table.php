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
        Schema::create('camaras', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->string('ip');
        $table->string('ubicacion');
        $table->enum('estado', ['DISPONIBLE', 'CAIDA', 'ESPERA']);
        $table->timestamp('ultima_conexion')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('camaras');
    }
};
