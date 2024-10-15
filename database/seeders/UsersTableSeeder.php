<?php

namespace Database\Seeders;

use App\Enums\Roles;
use App\Models\Module;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contacto = User::updateOrCreate([
            'id' => 1,
            'email' => 'contacto@strappberry.com',
        ], [
            'name' => 'Strappberry',
            'password' => '$2y$12$X0uJ.e5uc25eVFJ.MeBsBOPJ0WFbeiU7q.mVRhoOjy/FhMAMMxolm',
        ]);

        $hibran = User::updateOrCreate([
            'id' => 2,
            'email' => 'hibran@strappberry.com',
        ], [
            'name' => 'Hibran',
            'password' => '$2y$12$Tyo08ZHT42LG0.8QvrQLtuq1uR.8Z4bak7Jd/Wdotf5E7irJy8NxG',
        ]);

        /** @var \App\Models\Team $team */
        $team = $contacto->ownedTeams()->updateOrCreate([
            'id' => 1,
        ], [
            'name' => config('app.name'),
            'personal_team' => true,
            'main_team' => true,
        ]);

        $team->modules()->sync(
            Module::all()->pluck('id')->toArray()
        );

        $hibran->teams()->attach($team->id);

        $contacto->update([
            'current_team_id' => $team->id,
        ]);
        $hibran->update([
            'current_team_id' => $team->id,
        ]);

        setPermissionsTeamId($team->id);

        // Asigar rol admin a los usuarios
        $contacto->assignRole(Roles::SUPER_ADMIN->value);
        $hibran->assignRole(Roles::SUPER_ADMIN->value);

        // Asignar todos los permisos a los usuarios
        $permissionLists = Module::all()->permissionsList();
        $contacto->syncPermissions($permissionLists);
        $hibran->syncPermissions($permissionLists);
    }
}
