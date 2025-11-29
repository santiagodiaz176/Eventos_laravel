<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Inserta el estado 'Pospuesta' con id 4
        DB::table('estadoreserva')->insert([
            'id_estadoserva' => 4,
            'nombre_estado'  => 'Pospuesta',
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
    }

    public function down()
    {
        // Elimina el estado por su id (rollback)
        DB::table('estadoreserva')->where('id_estadoserva', 4)->delete();
    }
};
