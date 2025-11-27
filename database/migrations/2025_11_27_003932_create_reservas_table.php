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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();

            // Relación con usuarios
            $table->unsignedBigInteger('usuario_id');

            $table->string('nombre');
            $table->string('celular');
            $table->string('correo');
            $table->date('fecha');
            $table->string('tipo_evento');

            // Estado de la reserva
            $table->string('estado_reserva')->default('pendiente');

            $table->timestamps();

            // Foreign key manual (porque usuario usa id_usuario)
            $table->foreign('usuario_id')
                ->references('id_usuario')
                ->on('usuarios')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
