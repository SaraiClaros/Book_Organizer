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
        Schema::create('historial_actividades', function (Blueprint $table) {
            $table->increments('historial_id'); 
            $table->unsignedInteger('usuarios_id');
            $table->string('accion'); 
            $table->text('detalle')->nullable();
            $table->dateTime('fecha');
            $table->timestamps();

            $table->foreign('usuarios_id')->references('usuarios_id')->on('usuarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_actividades');
    }
};
