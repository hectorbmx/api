<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Eliminar la columna 'role_id' si existe
            
    
            // Cambiar la columna 'rol' a tipo 'unsignedBigInteger' (en caso de que ya sea varchar)
            $table->unsignedBigInteger('rol')->nullable()->change();
    
            // Establecer la relación con la tabla 'roles'
            $table->foreign('rol')->references('id')->on('roles')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Revertir cambios en caso de rollback
            $table->dropForeign(['rol']);
            $table->dropColumn('rol');
        });
    }
};
