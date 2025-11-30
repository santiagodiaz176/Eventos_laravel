<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('suscripciones', function (Blueprint $table) {

            $table->id('id_suscripcion');

            // Puede ser NULL para visitantes
            $table->unsignedBigInteger('id_usuario')->nullable();

            // Correo del suscriptor (visitor o usuario)
            $table->string('correo', 100)->unique();

            // Para futuras suscripciones de pago (no obligatorio ahora)
            $table->enum('tipo', [
                'un mes',
                'un trimestre',
                'un semestre',
                'un año'
            ])->nullable();

            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();

            $table->enum('estado', ['activo', 'inactivo'])
                  ->default('activo');

            $table->timestamp('fecha_registro')->useCurrent();

            // Relación con usuarios
            $table->foreign('id_usuario')
                  ->references('id_usuario')
                  ->on('usuarios')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('suscripciones');
    }
};
