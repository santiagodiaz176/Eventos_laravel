<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id('id_cita');
            $table->string('nombre', 60);
            $table->string('telefono', 20);
            $table->string('correo', 255)->nullable(); // correo del usuario
            $table->date('fecha_cita');
            $table->time('hora_cita')->nullable(); // hora de la cita
            $table->string('tipo_evento', 50)->nullable(); // tipo de evento
            $table->timestamp('fecha_registro')->useCurrent(); // fecha de registro automática

            // FK usuario
            $table->unsignedBigInteger('id_usuario');

            // FK estado reserva
            $table->unsignedBigInteger('id_estadoserva');

            // FK evento
            $table->unsignedBigInteger('id_evento'); // <-- Nueva columna

            // Relaciones
            $table->foreign('id_usuario')
                  ->references('id_usuario')
                  ->on('usuarios')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('id_estadoserva')
                  ->references('id_estadoserva')
                  ->on('estadoreserva')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->foreign('id_evento')
                  ->references('id_evento')
                  ->on('eventos')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('citas');
    }
};
