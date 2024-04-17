<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Guardar los roles en la base de datos
        $this->call(RolSeeder::class);

        // Guardar el usuario principal en la base de datos
        $this->call(UserAdminSeeder::class);
    }
}
