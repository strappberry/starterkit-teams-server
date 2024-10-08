<?php

namespace App\Livewire\Forms;

use App\Actions\Roles\ResolvePermissionList;
use App\Enums\Roles;
use App\Models\Team;
use App\Models\User;
use Livewire\Form;
use Spatie\Permission\Models\Role;

class TeamForm extends Form
{
    public $id;

    public $user_id;

    public $name;

    public $personal_team = true;

    public $admin_name;

    public $admin_email;

    public $admin_password;

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'personal_team' => ['boolean'],
        ];

        if (! $this->id) {
            $rules['admin_name'] = ['required', 'string', 'max:255'];
            $rules['admin_email'] = ['required', 'string', 'email', 'unique:users,email'];
            $rules['admin_password'] = ['required', 'string', 'min:8'];
        }

        return $rules;
    }

    public function store(): Team
    {
        if (! $this->id) {
            $this->user_id = User::create([
                'name' => $this->admin_name,
                'email' => $this->admin_email,
                'password' => $this->admin_password,
            ])->id;
        }

        $team = Team::updateOrCreate(
            ['id' => $this->id],
            [
                'user_id' => $this->user_id,
                'name' => $this->name,
                'personal_team' => $this->personal_team,
            ],
        );

        if (! $this->id) {
            // Crear los roles para el equipo
            foreach (Roles::teamRoles() as $role) {
                $role = Role::updateOrCreate(
                    [
                        'name' => $role->value,
                        'guard_name' => 'web',
                        'team_id' => $team->id,
                    ],
                    []
                );
            }

            // Sincronizar todos los permisos al dueño del equipo
            setPermissionsTeamId($team->id);
            $resolver = app(ResolvePermissionList::class);
            $team->owner->syncPermissions($resolver->plain(false));
        }

        return $team;
    }
}
