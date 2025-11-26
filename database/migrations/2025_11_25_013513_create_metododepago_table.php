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
Schema::create('metododepago', function (Blueprint $table) {
$table->id('id_metodo');
$table->string('descripcion_metodo', 200);
$table->enum('tipo_metodo', [
'Tarjeta de crédito',
'Tarjeta de débito',
'Transferencia bancaria'
]);
});
}

public function down()
{
Schema::dropIfExists('metododepago');
}

};
