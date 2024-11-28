<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Entreno;

class EntrenoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Entreno::create([
            'fecha' => now()->format('Y-m-d'), // Fecha del día actual
            'titulo' => 'Entrenamiento de Prueba',
            'seccion1' => 'Calentamiento: 10 minutos de cardio',
            'seccion2' => 'Parte Principal: Circuito de fuerza',
            'seccion3' => 'Estiramientos: 15 minutos',
            'seccion4' => 'Nota: Hidratarse bien durante el ejercicio',
            'usuario_id' => 1, // Asegúrate de tener un usuario con ID 1 en la tabla `users`
        ]);
    }
}
