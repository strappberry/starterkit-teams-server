<x-first-dashboard>
    {{ Breadcrumbs::render('dashboard.users.edit', $user) }}

    @livewire('dashboard.users.form-component', [
        'team' => $team,
        'user' => $user,
    ])
</x-first-dashboard>
