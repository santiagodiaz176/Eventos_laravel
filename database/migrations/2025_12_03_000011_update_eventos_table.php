<?php
use Illuminate\Database\Migrations\Migration; 
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Eliminar la columna solo si existe
        Schema::table('eventos', function (Blueprint $table) {
            if (Schema::hasColumn('eventos', 'lugar_evento')) {
                $table->dropColumn('lugar_evento');
            }
        });

        // Añadir id_zona si no existe
        Schema::table('eventos', function (Blueprint $table) {
            if (!Schema::hasColumn('eventos', 'id_zona')) {
                $table->unsignedBigInteger('id_zona')->nullable()->after('hora_evento');
                $table->foreign('id_zona')->references('id_zona')->on('zonas')->onDelete('set null');
            }
        });
    }

    public function down(): void
    {
        Schema::table('eventos', function (Blueprint $table) {

            // Verificar si existe la foreign key antes de eliminarla
            $fkExists = DB::select("
                SELECT CONSTRAINT_NAME 
                FROM information_schema.KEY_COLUMN_USAGE 
                WHERE TABLE_NAME = 'eventos' 
                  AND COLUMN_NAME = 'id_zona' 
                  AND CONSTRAINT_SCHEMA = DATABASE()
                  AND REFERENCED_TABLE_NAME IS NOT NULL;
            ");

            if ($fkExists) {
                $table->dropForeign(['id_zona']);
            }

            // Quitar columna solo si existe
            if (Schema::hasColumn('eventos', 'id_zona')) {
                $table->dropColumn('id_zona');
            }

            // Restaurar columna solo si no existe
            if (!Schema::hasColumn('eventos', 'lugar_evento')) {
                $table->string('lugar_evento', 200);
            }
        });
    }
};
