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
Schema::create('eventos_servicios', function (Blueprint $table) {
$table->unsignedBigInteger('id_evento');
$table->unsignedBigInteger('id_servicio');


    $table->primary(['id_evento', 'id_servicio']);

    $table->foreign('id_evento')
          ->references('id_evento')->on('eventos')
          ->onDelete('cascade');

    $table->foreign('id_servicio')
          ->references('id_servicio')->on('servicios')
          ->onDelete('cascade');
});

}

public function down()
{
Schema::dropIfExists('eventos_servicios');
}

};
