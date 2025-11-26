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
Schema::create('citas', function (Blueprint $table) {
$table->id('id_cita');
$table->string('nombre', 60);
$table->string('telefono', 20);
$table->date('fecha_cita');
$table->timestamp('fecha_registro')->useCurrent();
$table->unsignedBigInteger('id_usuario');


    $table->foreign('id_usuario')
          ->references('id_usuario')->on('usuarios')
          ->onDelete('cascade')
          ->onUpdate('cascade');
});


}

public function down()
{
Schema::dropIfExists('citas');
}

};
