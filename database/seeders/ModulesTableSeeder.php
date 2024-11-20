<?php

namespace Database\Seeders;

use App\Enums\Roles;
use App\Models\Module;
use Illuminate\Database\Seeder;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Definir modulos del sistema
        // Es importante agregar la clave de array que indicará el id del mismo
        $modules = [
            1 => [
                'name' => 'Equipos',
                'slug' => 'equipos',
                'main_team' => true,
                'roles' => [Roles::SUPER_ADMIN->value],
            ],
            2 => [
                'name' => 'Usuarios',
                'slug' => 'usuarios',
                'main_team' => false,
                'roles' => [Roles::SUPER_ADMIN->value, Roles::ADMIN->value],
            ],
            3 => [
                'name' => 'Configuración',
                'slug' => 'configuracion',
            ],
        ];

        foreach ($modules as $id => $module) {
            Module::updateOrCreate(
                ['id' => $id],
                $module
            );
        }
    }
}
