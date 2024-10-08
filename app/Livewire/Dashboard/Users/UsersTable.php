<?php

namespace App\Livewire\Dashboard\Users;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UsersTable extends DataTableComponent
{
    public Team $team;

    public function builder(): Builder
    {
        return User::query()
            ->where(function ($query) {
                return $query->whereHas('teams', function (Builder $query) {
                    $query->where('team_id', $this->team->id);
                })
                    ->orWhere('id', $this->team->user_id);
            });
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('name');
        $this->setPerPageAccepted([10, 25, 50, 100]);

        $this->setConfigurableAreas([
            'toolbar-right-end' => 'datatables.users.toolbar-right-end',
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make(__('panel.general.nombre'), 'name')
                ->searchable()
                ->sortable(),
            Column::make(__('panel.general.email'), 'email')
                ->searchable()
                ->sortable(),

            Column::make(__('panel.general.acciones'), 'id')
                ->format(function ($id) {
                    return view('datatables.users.row-actions', compact('id'));
                }),
        ];
    }

    public function delete($id)
    {
        $user = User::find($id);

        if (! $user) {
            return;
        }

        if ($user->teams()->count() > 1) {
            $otherTeam = $user->teams()->where('team_id', '!=', $this->team->id)->first();
            $user->switchTeam($otherTeam);
            $user->teams()->detach($this->team->id);
        } else {
            $user->delete();
        }
    }
}
