<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comidas', function (Blueprint $table) {
            $table->id('id_comida');
            $table->string('nombre_comida', 100);
            $table->text('descripcion')->nullable();
            $table->decimal('precio', 10, 2);
            $table->enum('tipo', ['entrada', 'plato_fuerte', 'postre']);
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        // Insertar comidas de ejemplo
        DB::table('comidas')->insert([
            // Entradas
            ['nombre_comida' => 'Ensalada César', 'descripcion' => 'Fresca ensalada con pollo', 'precio' => 15000, 'tipo' => 'entrada', 'activo' => true],
            ['nombre_comida' => 'Tabla de quesos', 'descripcion' => 'Variedad de quesos nacionales', 'precio' => 18000, 'tipo' => 'entrada', 'activo' => true],
            ['nombre_comida' => 'Croquetas de jamón', 'descripcion' => 'Croquetas caseras', 'precio' => 12000, 'tipo' => 'entrada', 'activo' => true],
            
            // Platos fuertes
            ['nombre_comida' => 'Arroz con pollo', 'descripcion' => 'Tradicional arroz con pollo colombiano', 'precio' => 25000, 'tipo' => 'plato_fuerte', 'activo' => true],
            ['nombre_comida' => 'Bandeja paisa', 'descripcion' => 'Plato típico antioqueño', 'precio' => 35000, 'tipo' => 'plato_fuerte', 'activo' => true],
            ['nombre_comida' => 'Pollo a la plancha', 'descripcion' => 'Con papas y ensalada', 'precio' => 28000, 'tipo' => 'plato_fuerte', 'activo' => true],
            
            // Postres
            ['nombre_comida' => 'Tres leches', 'descripcion' => 'Postre tradicional', 'precio' => 10000, 'tipo' => 'postre', 'activo' => true],
            ['nombre_comida' => 'Brownie con helado', 'descripcion' => 'Brownie caliente con helado', 'precio' => 12000, 'tipo' => 'postre', 'activo' => true],
            ['nombre_comida' => 'Flan de caramelo', 'descripcion' => 'Flan casero', 'precio' => 8000, 'tipo' => 'postre', 'activo' => true],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('comidas');
    }
};