<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('servicios_contratados', function (Blueprint $table) {
            $table->id('id_servicio_contratado');
            $table->unsignedBigInteger('id_cita');
            $table->unsignedBigInteger('id_evento');
            
            // Servicios básicos (solo precio)
            $table->boolean('incluye_dj')->default(false);
            $table->boolean('incluye_sonido')->default(false);
            $table->boolean('incluye_animador')->default(false);
            
            // Salón
            $table->unsignedBigInteger('id_salon')->nullable();
            
            // Decoración
            $table->unsignedBigInteger('id_decoracion')->nullable();
            
            // Total
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('iva', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            
            // Estado
            $table->enum('estado', ['borrador', 'enviado', 'aprobado'])->default('borrador');
            $table->timestamp('fecha_envio')->nullable();
            $table->timestamp('fecha_aprobacion')->nullable();
            
            $table->timestamps();
            
            $table->foreign('id_cita')->references('id_cita')->on('citas')->onDelete('cascade');
            $table->foreign('id_evento')->references('id_evento')->on('eventos')->onDelete('cascade');
            $table->foreign('id_salon')->references('id_salon')->on('salones')->onDelete('set null');
            $table->foreign('id_decoracion')->references('id_decoracion')->on('decoraciones')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('servicios_contratados');
    }
};