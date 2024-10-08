<?php

namespace App\Actions\Roles;

class ResolvePermissionList
{
    /**
     * Resuelve la lista de permisos a mostrar disponibles agrupados por modulos.
     * Se puede indicar si se desea obtener los permisos del team principal.
     */
    public function handle(bool $mainTeam = false)
    {
        $permissions = config('roles.permissions');
        $mainTeamModules = config('roles.main_team_modules', []);

        // En caso de que el team no sea el principal se removemos los modulos exclusivos
        if (! $mainTeam) {
            $permissions = array_filter($permissions, function ($key) use ($mainTeamModules) {
                return ! in_array($key, $mainTeamModules);
            }, ARRAY_FILTER_USE_KEY);
        }

        return $permissions;
    }

    /**
     * Resuelve la lista de permisos a mostrar disponibles sin agrupar por modulos.
     * Se puede indicar si se desea obtener los permisos del team principal.
     */
    public function plain(bool $mainTeam = false)
    {
        return array_merge(...array_values($this->handle($mainTeam)));
    }
}
