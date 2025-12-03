<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('salones', function (Blueprint $table) {
            $table->id('id_salon');
            $table->string('nombre_salon', 100);
            $table->string('direccion', 200);
            $table->string('zona', 50); // Laureles, Poblado, Envigado
            $table->integer('capacidad');
            $table->decimal('precio', 10, 2);
            $table->text('descripcion')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        DB::table('salones')->insert([
            ['nombre_salon' => 'Salón Laureles Premium', 'direccion' => 'Calle 33 #70-20, Laureles', 'zona' => 'Laureles', 'capacidad' => 150, 'precio' => 800000, 'descripcion' => 'Amplio salón en el corazón de Laureles', 'activo' => true],
            ['nombre_salon' => 'Salón El Poblado Elite', 'direccion' => 'Carrera 43A #5-111, El Poblado', 'zona' => 'El Poblado', 'capacidad' => 200, 'precio' => 1200000, 'descripcion' => 'Salón exclusivo en zona privilegiada', 'activo' => true],
            ['nombre_salon' => 'Salón Envigado Gardens', 'direccion' => 'Calle 37 Sur #43-10, Envigado', 'zona' => 'Envigado', 'capacidad' => 120, 'precio' => 650000, 'descripcion' => 'Hermoso salón con jardín', 'activo' => true],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('salones');
    }
};
