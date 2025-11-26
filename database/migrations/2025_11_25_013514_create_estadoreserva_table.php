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
Schema::create('estadoreserva', function (Blueprint $table) {
$table->id('id_estadoserva');
$table->string('descripcion', 200);
});
}

public function down()
{
Schema::dropIfExists('estadoreserva');
}

};
