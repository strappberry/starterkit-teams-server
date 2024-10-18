<?php

namespace App\Livewire\Dashboard\Teams;

use App\Models\Team;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use TallStackUi\Traits\Interactions;

class TeamsTable extends DataTableComponent
{
    use Interactions;

    public function builder(): Builder
    {
        return Team::query()
            ->select('teams.*');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('name');

        $this->setConfigurableAreas([
            'toolbar-right-end' => 'datatables.teams.toolbar-right-end',
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->sortable(),
            Column::make('Name', 'name')
                ->searchable()
                ->sortable(),
            Column::make(__('panel.general.acciones'), 'id')
                ->format(function ($id, Team $model) {
                    return view('datatables.teams.row-actions', [
                        'id' => $id,
                        'isMain' => $model->main_team,
                    ]);
                }),
        ];
    }

    public function delete($id)
    {
        $this->toast()->success(
            'TODO: implementar'
        )->send();
        // TODO: implementar la eliminación de un equipo
        // considerar usuarios en multiples equipos
    }
}
