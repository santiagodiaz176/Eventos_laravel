<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('zonas', function (Blueprint $table) {
            $table->id('id_zona');
            $table->string('nombre_zona', 100);
            $table->string('descripcion', 200)->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        DB::table('zonas')->insert([
            ['id_zona' => 1, 'nombre_zona' => 'Laureles', 'descripcion' => 'Zona tradicional y céntrica de Medellín', 'activo' => true],
            ['id_zona' => 2, 'nombre_zona' => 'El Poblado', 'descripcion' => 'Zona exclusiva y moderna', 'activo' => true],
            ['id_zona' => 3, 'nombre_zona' => 'Envigado', 'descripcion' => 'Municipio cercano, tranquilo y accesible', 'activo' => true],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('zonas');
    }
};

