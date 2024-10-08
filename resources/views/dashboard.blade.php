<x-first-dashboard>
    {{ Breadcrumbs::render('dashboard') }}

    <x-card class="p-4">
        {{ auth()->user()->name }}
        <x-ui.badge>
            {{ auth()->user()->email }}
        </x-ui.badge>
    </x-card>
</x-first-dashboard>
