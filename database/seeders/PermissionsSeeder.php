<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = Module::all();

        foreach ($modules as $module) {
            foreach ($module->permissions as $permission) {
                Permission::updateOrCreate([
                    'name' => $permission,
                ], [
                    'guard_name' => 'web',
                ]);
            }
        }
    }
}
