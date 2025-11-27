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
Schema::create('usuarios', function (Blueprint $table) {
$table->id('id_usuario');
$table->string('usuario', 60);
$table->string('email', 255)->unique();
$table->string('clave', 255);
$table->string('nombre', 50);
$table->string('apellidos', 50);
$table->string('perfil', 10)->default('user');
$table->boolean('estado')->default(true);

$table->timestamps();
});
}

public function down()
{
Schema::dropIfExists('usuarios');
}

};
