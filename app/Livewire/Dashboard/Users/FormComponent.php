<?php

namespace App\Livewire\Dashboard\Users;

use App\Enums\Roles;
use App\Livewire\Forms\UserForm;
use App\Models\Module;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;

class FormComponent extends Component
{
    public ?User $user = null;

    public UserForm $form;

    #[Locked]
    public Team $team;

    public function mount(): void
    {
        if ($this->user) {
            $this->form->fill([
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
                'role' => $this->user->roles->first()?->name,
                'permissions' => $this->user->permissions->pluck('name')->toArray() ?? [],
            ]);
        }
    }

    #[Computed]
    protected function permissions(): array
    {
        return $this->team
            ->modules
            ->modulesPermissions();
    }

    public function updatedFormRole()
    {
        $modules = $this->team->modules()
            ->whereMainTeam($this->team->main_team)
            ->whereRole(Roles::from($this->form->role))
            ->get();

        $this->form->permissions = $modules->permissionsList();
    }

    public function setPermissionsForModule($module)
    {
        $permissions = Module::whereSlug($module)->first()->permissions ?? [];
        $missingPermissions = array_diff($permissions, $this->form->permissions);

        if (empty($missingPermissions)) {
            $this->form->permissions = array_diff($this->form->permissions, $permissions);

            return;
        }

        $this->form->permissions = array_merge($this->form->permissions, $missingPermissions);
    }

    public function save()
    {
        $this->validate();

        DB::transaction(function () {
            setPermissionsTeamId($this->team->id);
            $user = $this->form->store();

            if (! $this->team->hasUser($user)) {
                $user->teams()->attach($this->team);

                if ($user->current_team_id === null) {
                    $user->update(['current_team_id' => $this->team->id]);
                }
            }
        });

        to_route('dashboard.users.index');
    }

    public function render()
    {
        return view('livewire.dashboard.users.form-component', [
            'roles' => $this->team->main_team ? Roles::mainTeamRoles() : Roles::teamRoles(),
        ]);
    }
}
