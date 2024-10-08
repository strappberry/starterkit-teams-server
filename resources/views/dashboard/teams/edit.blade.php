<x-first-dashboard>
    {{ Breadcrumbs::render('dashboard.teams.edit', $team) }}

    @livewire('dashboard.teams.form-component', [
        'team' => $team,
    ])
</x-first-dashboard>
