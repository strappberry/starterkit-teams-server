<?php

namespace App\Models;

use App\Enums\Roles;
use App\Models\Collections\ModulesCollection;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    /** @use HasFactory<\Database\Factories\ModuleFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'main_team',
        'roles',
    ];

    protected $casts = [
        'main_team' => 'boolean',
        'roles' => 'array',
    ];

    public function newCollection(array $models = [])
    {
        return new ModulesCollection($models);
    }

    public function permissions(): Attribute
    {
        return Attribute::make(
            get: function () {
                $specialPermissions = config('roles.permissions.'.$this->slug, null);
                if (! is_null($specialPermissions)) {
                    return $specialPermissions;
                }

                return collect(['ver', 'crear', 'editar', 'eliminar'])
                    ->map(fn ($permission) => "{$permission} {$this->slug}")
                    ->toArray();
            },
        );
    }

    public function scopeWhereMainTeam($query, $mainTeam = false)
    {
        return $query
            ->when(
                $mainTeam,
                fn ($query) => $query,
                fn ($query) => $query->where('main_team', $mainTeam)
            );
    }

    public function scopeWhereRole($query, Roles $role)
    {
        return $query->whereJsonContains('roles', $role);
    }
}
