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
$table->unsignedBigInteger('id_usuario');
$table->string('correo', 100);
$table->enum('tipo', ['un mes', 'un trimestre', 'un semestre', 'un año']);
$table->date('fecha_inicio');
$table->date('fecha_fin')->nullable();
$table->enum('estado', ['activo', 'inactivo'])->default('activo');
$table->timestamp('fecha_registro')->useCurrent();


    $table->foreign('id_usuario')
          ->references('id_usuario')->on('usuarios')
          ->onDelete('cascade')
          ->onUpdate('cascade');
});


}

public function down()
{
Schema::dropIfExists('suscripciones');
}

};
