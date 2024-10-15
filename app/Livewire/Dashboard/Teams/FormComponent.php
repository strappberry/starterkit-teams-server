<?php

namespace App\Livewire\Dashboard\Teams;

use App\Livewire\Forms\TeamForm;
use App\Models\Module;
use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class FormComponent extends Component
{
    public ?Team $team = null;

    public TeamForm $form;

    public function mount(): void
    {
        if ($this->team) {
            $this->form->fill([
                'id' => $this->team->id,
                'user_id' => $this->team->user_id,
                'name' => $this->team->name,
                'personal_team' => $this->team->personal_team,
                'main_team' => $this->team->main_team,
                'modules' => $this->team->modules->pluck('id')->toArray(),
            ]);
        }
    }

    #[Computed]
    protected function modules(): Collection
    {
        return Module::query()
            ->whereMainTeam($this->form->main_team)
            ->get();
    }

    public function save(): void
    {
        $this->validate();

        DB::transaction(function () {
            $this->form->store();
        });

        to_route('dashboard.teams.index');
    }

    public function render(): View
    {
        return view('livewire.dashboard.teams.form-component');
    }
}
