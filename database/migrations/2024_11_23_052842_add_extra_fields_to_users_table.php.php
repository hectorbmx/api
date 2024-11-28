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
            $table->string('celular')->nullable()->after('email'); // Campo celular
            $table->date('fecha_nacimiento')->nullable()->after('celular'); // Campo fecha_nacimiento
            $table->string('foto')->nullable()->after('fecha_nacimiento'); // Campo foto
            $table->string('rol')->default('1')->after('foto'); // Campo rol con valor por defecto
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn(['celular', 'fecha_nacimiento', 'foto', 'rol']);

        });
    }
};
