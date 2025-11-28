<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Cambiar valor por defecto
        Schema::table('usuarios', function (Blueprint $table) {
            $table->string('perfil', 10)->default('usuario')->change();
        });

        // Convertir usuarios antiguos "user" a "usuario"
        DB::table('usuarios')
            ->where('perfil', 'user')
            ->update(['perfil' => 'usuario']);
    }

    public function down()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->string('perfil', 10)->default('user')->change();
        });
    }
};
