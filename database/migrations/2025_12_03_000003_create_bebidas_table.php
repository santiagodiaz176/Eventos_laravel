<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bebidas', function (Blueprint $table) {
            $table->id('id_bebida');
            $table->string('nombre_bebida', 100);
            $table->text('descripcion')->nullable();
            $table->decimal('precio', 10, 2);
            $table->enum('tipo', ['whisky', 'vodka', 'ron', 'aguardiente', 'cerveza', 'vino']);
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        DB::table('bebidas')->insert([
            ['nombre_bebida' => 'Whisky Old Parr', 'descripcion' => 'Whisky escocés', 'precio' => 15000, 'tipo' => 'whisky', 'activo' => true],
            ['nombre_bebida' => 'Whisky Buchanans', 'descripcion' => 'Whisky premium', 'precio' => 18000, 'tipo' => 'whisky', 'activo' => true],
            ['nombre_bebida' => 'Vodka Absolut', 'descripcion' => 'Vodka sueco', 'precio' => 12000, 'tipo' => 'vodka', 'activo' => true],
            ['nombre_bebida' => 'Ron Medellín Añejo', 'descripcion' => 'Ron colombiano', 'precio' => 10000, 'tipo' => 'ron', 'activo' => true],
            ['nombre_bebida' => 'Aguardiente Antioqueño', 'descripcion' => 'Tradicional aguardiente', 'precio' => 8000, 'tipo' => 'aguardiente', 'activo' => true],
            ['nombre_bebida' => 'Cerveza Club Colombia', 'descripcion' => 'Cerveza nacional', 'precio' => 5000, 'tipo' => 'cerveza', 'activo' => true],
            ['nombre_bebida' => 'Vino tinto Casillero del Diablo', 'descripcion' => 'Vino chileno', 'precio' => 14000, 'tipo' => 'vino', 'activo' => true],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('bebidas');
    }
};