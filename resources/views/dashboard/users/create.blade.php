<x-first-dashboard>
    {{ Breadcrumbs::render('dashboard.users.create') }}

    @livewire('dashboard.users.form-component', [
        'team' => $team,
    ])
</x-first-dashboard>
