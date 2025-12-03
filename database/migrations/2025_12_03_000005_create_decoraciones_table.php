<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('decoraciones', function (Blueprint $table) {
            $table->id('id_decoracion');
            $table->string('tipo_decoracion', 50); // Casual, Sencilla, Del Sueño
            $table->text('descripcion');
            $table->decimal('precio', 10, 2);
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        DB::table('decoraciones')->insert([
            ['tipo_decoracion' => 'Casual', 'descripcion' => 'Decoración básica con globos y manteles', 'precio' => 150000, 'activo' => true],
            ['tipo_decoracion' => 'Sencilla', 'descripcion' => 'Decoración elegante con centros de mesa y flores', 'precio' => 300000, 'activo' => true],
            ['tipo_decoracion' => 'Del Sueño', 'descripcion' => 'Decoración premium personalizada con luces, flores premium y montaje completo', 'precio' => 600000, 'activo' => true],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('decoraciones');
    }
};