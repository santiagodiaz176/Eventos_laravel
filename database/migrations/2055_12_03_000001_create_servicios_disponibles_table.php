<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
   public function up(): void
{
    if (!Schema::hasTable('servicios_disponibles')) {

        Schema::create('servicios_disponibles', function (Blueprint $table) {
            $table->id('id_servicio');
            $table->string('nombre_servicio', 100);
            $table->text('descripcion')->nullable();
            $table->decimal('precio_base', 10, 2)->default(0);
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        DB::table('servicios_disponibles')->insert([
            ['nombre_servicio' => 'DJ', 'descripcion' => 'Servicio de DJ profesional', 'precio_base' => 200000, 'activo' => true],
            ['nombre_servicio' => 'Comida', 'descripcion' => 'Servicio de catering', 'precio_base' => 0, 'activo' => true],
            ['nombre_servicio' => 'Salones', 'descripcion' => 'Alquiler de salones', 'precio_base' => 0, 'activo' => true],
            ['nombre_servicio' => 'Decoración', 'descripcion' => 'Decoración del evento', 'precio_base' => 0, 'activo' => true],
            ['nombre_servicio' => 'Sonido', 'descripcion' => 'Sistema de sonido profesional', 'precio_base' => 150000, 'activo' => true],
            ['nombre_servicio' => 'Bebidas', 'descripcion' => 'Bebidas alcohólicas', 'precio_base' => 0, 'activo' => true],
            ['nombre_servicio' => 'Animador', 'descripcion' => 'Animador para el evento', 'precio_base' => 180000, 'activo' => true],
        ]);
    }
}

};