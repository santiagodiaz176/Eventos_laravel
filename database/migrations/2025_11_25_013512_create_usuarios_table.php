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
            $table->id('id_usuario'); // PK
            $table->string('usuario', 60); // login (puede ser igual al email)
            $table->string('email', 255)->unique();
            $table->string('clave', 255); // contraseña encriptada
            $table->string('nombre', 50);
            $table->string('apellidos', 50);
            $table->enum('perfil', ['usuario','admin'])->default('usuario'); // perfil
            $table->boolean('estado')->default(true); // 1=activo, 0=inactivo

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
};
