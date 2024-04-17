<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Rol;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear roles
        Rol::create([
            'nombre' => 'administrador',
            'descripcion' => 'Rol de administrador, exclusivo para el grupo de desarrolladores',
        ]);
    }
}
