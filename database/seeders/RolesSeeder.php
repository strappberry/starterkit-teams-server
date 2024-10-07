<?php

namespace Database\Seeders;

use App\Enums\Roles;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mainTeam = 1;

        foreach (Roles::mainTeamRoles() as $role) {
            $role = Role::updateOrCreate(
                [
                    'name' => $role->value,
                    'guard_name' => 'web',
                    'team_id' => $mainTeam,
                ],
                []
            );
        }
    }
}
