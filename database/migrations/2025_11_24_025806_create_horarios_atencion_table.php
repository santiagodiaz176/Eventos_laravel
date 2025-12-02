<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('horarios_atencion', function (Blueprint $table) {
           $table->id('id_horario');
           $table->time('hora_inicio');
           $table->time('hora_fin');
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('horarios_atencion');
    }
};
