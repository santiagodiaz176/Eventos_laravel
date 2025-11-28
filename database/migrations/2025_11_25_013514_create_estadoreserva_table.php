<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('estadoreserva', function (Blueprint $table) {
            $table->id('id_estadoserva');
            $table->string('nombre_estado', 50); // 'Pendiente', 'Aprobada', 'Rechazada'
            $table->timestamps();
        });

        // Insertar los estados iniciales
        DB::table('estadoreserva')->insert([
            ['id_estadoserva' => 1, 'nombre_estado' => 'Pendiente', 'created_at' => now(), 'updated_at' => now()],
            ['id_estadoserva' => 2, 'nombre_estado' => 'Aprobada', 'created_at' => now(), 'updated_at' => now()],
            ['id_estadoserva' => 3, 'nombre_estado' => 'Rechazada', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('estadoreserva');
    }
};
