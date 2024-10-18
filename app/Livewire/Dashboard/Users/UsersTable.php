<?php

namespace App\Livewire\Dashboard\Users;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use TallStackUi\Traits\Interactions;

class UsersTable extends DataTableComponent
{
    use Interactions;

    #[Locked]
    public Team $team;

    public $deleteId;

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

    public function confirmDelete($id)
    {
        $this->deleteId = $id;

        $this->dialog()
            ->question(__('panel.general.eliminar'), __('panel.usuarios.desea_eliminar'))
            ->confirm(__('Yes'), 'deleteConfirmed')
            ->cancel(__('No'), 'deleteCancelled')
            ->send();
    }

    public function deleteCancelled()
    {
        $this->deleteId = null;
    }

    public function deleteConfirmed()
    {
        $user = User::find($this->deleteId);

        if (! $user) {
            return;
        }

        if (! $this->team->hasUser($user)) {
            return;
        }

        if ($user->teams()->count() > 1) {
            $otherTeam = $user->teams()->where('team_id', '!=', $this->team->id)->first();
            $user->switchTeam($otherTeam);
            $user->teams()->detach($this->team->id);
        } else {
            $user->delete();
        }

        $this->toast()->success(__('panel.usuarios.eliminado_correctamente'))->send();
    }
}
