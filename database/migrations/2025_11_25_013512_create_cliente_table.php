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
Schema::create('cliente', function (Blueprint $table) {
$table->id('id_cliente');
$table->string('nombre_cliente', 50);
$table->string('apellido_cliente', 50);
$table->string('telefono_cliente', 20);
$table->string('email_cliente', 100);
$table->string('direccion_cliente', 200);
});
}

public function down()
{
Schema::dropIfExists('cliente');
}


};

