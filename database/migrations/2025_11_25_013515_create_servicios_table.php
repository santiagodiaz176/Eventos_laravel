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
Schema::create('servicios', function (Blueprint $table) {
$table->id('id_servicio');
$table->string('nombre_servicio', 100);
$table->decimal('precio', 10, 2);
});
}

public function down()
{
Schema::dropIfExists('servicios');
}

};
