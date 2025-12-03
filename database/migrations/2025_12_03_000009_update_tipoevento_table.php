<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Desactivar claves foráneas temporalmente
        Schema::disableForeignKeyConstraints();

        DB::table('tipoevento')->truncate();

        // Reactivar claves foráneas
        Schema::enableForeignKeyConstraints();

        // Insertar nuevos tipos de evento
        DB::table('tipoevento')->insert([
            ['id_tipoevento' => 1, 'descripcion_tipoevento' => 'Formal'],
            ['id_tipoevento' => 2, 'descripcion_tipoevento' => 'Familiar'],
            ['id_tipoevento' => 3, 'descripcion_tipoevento' => 'Social'],
            ['id_tipoevento' => 4, 'descripcion_tipoevento' => 'Evento Grande'],
            ['id_tipoevento' => 5, 'descripcion_tipoevento' => 'Privado'],
            ['id_tipoevento' => 6, 'descripcion_tipoevento' => 'Ejecutivo'],
            ['id_tipoevento' => 7, 'descripcion_tipoevento' => 'Corporativo'],
            ['id_tipoevento' => 8, 'descripcion_tipoevento' => 'Celebración'],
        ]);
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('tipoevento')->truncate();
        Schema::enableForeignKeyConstraints();
    }
};
