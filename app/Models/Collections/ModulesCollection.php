<?php

namespace App\Models\Collections;

use Illuminate\Database\Eloquent\Collection;

class ModulesCollection extends Collection
{
    public function modulesPermissions()
    {
        return $this
            ->pluck('permissions', 'slug')
            ->toArray();
    }

    public function permissionsList()
    {
        return $this
            ->flatMap(fn ($module) => $module->permissions)
            ->toArray();
    }
}
