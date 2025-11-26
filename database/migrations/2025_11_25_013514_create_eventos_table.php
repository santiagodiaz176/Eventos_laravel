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
Schema::create('eventos', function (Blueprint $table) {
$table->id('id_evento');
$table->string('nombre_evento', 100);
$table->text('descripcion_evento')->nullable();
$table->date('fecha_evento');
$table->time('hora_evento');
$table->string('lugar_evento', 200);


    $table->unsignedBigInteger('id_cliente');
    $table->unsignedBigInteger('id_tipoevento');
    $table->unsignedBigInteger('id_metodo_pago');
    $table->unsignedBigInteger('id_estado');

    $table->foreign('id_cliente')->references('id_cliente')->on('cliente');
    $table->foreign('id_tipoevento')->references('id_tipoevento')->on('tipoevento');
    $table->foreign('id_metodo_pago')->references('id_metodo')->on('metododepago');
    $table->foreign('id_estado')->references('id_estadoserva')->on('estadoreserva');
});
}
public function down()
{
Schema::dropIfExists('eventos');
}

};
