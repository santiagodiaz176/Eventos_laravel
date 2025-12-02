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
            $table->string('correo', 255)->nullable();
            $table->date('fecha_cita');
            // dejamos hora_cita por compatibilidad, pero puede ser nullable
            $table->time('hora_cita')->nullable();
            $table->string('tipo_evento', 50)->nullable();
            $table->timestamp('fecha_registro')->useCurrent();

            // FK usuario
            $table->unsignedBigInteger('id_usuario')->nullable();

            // FK estado reserva
            $table->unsignedBigInteger('id_estadoserva')->nullable();

            // FK evento (si tu diseño lo requiere)
            $table->unsignedBigInteger('id_evento')->nullable();

            // FK HORARIO ATENCION
            $table->unsignedBigInteger('id_horario')->nullable();

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

            $table->foreign('id_horario')
                  ->references('id_horario')
                  ->on('horarios_atencion')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('citas');
    }
};
