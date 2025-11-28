<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eventos', function (Blueprint $table) {

            $table->id('id_evento');

            $table->string('nombre_evento', 100);
            $table->text('descripcion_evento')->nullable();
            $table->date('fecha_evento');
            $table->time('hora_evento');
            $table->string('lugar_evento', 200);

            // NUEVA COLUMNA: cantidad de personas
            $table->smallInteger('cantidad_personas')->nullable()->default(0);

            // FK USUARIO (QUIEN CREA EL EVENTO)
            $table->unsignedBigInteger('id_usuario');

            // OTRAS RELACIONES
            $table->unsignedBigInteger('id_tipoevento');
            $table->unsignedBigInteger('id_estado');

            // FOREIGN KEYS
            $table->foreign('id_usuario')
                  ->references('id_usuario')
                  ->on('usuarios')
                  ->onDelete('cascade');

            $table->foreign('id_tipoevento')
                  ->references('id_tipoevento')
                  ->on('tipoevento');

            $table->foreign('id_estado')
                  ->references('id_estadoserva')
                  ->on('estadoreserva');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
