<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('servicio_bebidas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_servicio_contratado');
            $table->unsignedBigInteger('id_bebida');
            $table->integer('cantidad')->default(1);
            $table->decimal('precio_unitario', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
            
            $table->foreign('id_servicio_contratado')->references('id_servicio_contratado')->on('servicios_contratados')->onDelete('cascade');
            $table->foreign('id_bebida')->references('id_bebida')->on('bebidas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('servicio_bebidas');
    }
};