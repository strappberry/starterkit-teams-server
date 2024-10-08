<x-first-dashboard>
    {{ Breadcrumbs::render('dashboard.users.index') }}

    @livewire('dashboard.users.users-table', [
        'team' => $team,
    ])
</x-first-dashboard>
