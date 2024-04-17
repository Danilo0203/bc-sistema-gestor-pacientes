<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Rol;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asignar rol de administrador al usuario principal
        $rolAdmin = Rol::where('nombre', 'Administrador')->first();
        
        // Crear usuario principal y usar las variables de entorno para llenar los campos
        $user = User::create([
        'nombre' => env('ADMIN_NAME'),
        'usuario' => env('ADMIN_USERNAME'),
        'email' => env('ADMIN_EMAIL'),
        'password' => bcrypt(env('ADMIN_PASSWORD')),
        'rol_id' => $rolAdmin->id,
        ]);

        // Asignar token de acceso al usuario principal
        $token = $user->createToken('auth_token')->plainTextToken;
    }
}
