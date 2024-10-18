<div class="space-x-2">
    @can('editar equipos')
        <x-ui.tooltip :text="__('panel.general.editar')">
            <a href="{{ route('dashboard.teams.edit', $id) }}">
                @svg('heroicon-o-pencil-square', 'w-5 h-5 text-primary-800 dark:text-primary-300')
            </a>
        </x-ui.tooltip>
    @endcan

    @can('eliminar equipos')
        @if (!$isMain)
            <x-ui.tooltip :text="__('panel.general.eliminar')">
                <button type="button" wire:click="delete({{ $id }})">
                    @svg('heroicon-o-trash', 'w-5 h-5 text-red-800 dark:text-red-400')
                </button>
            </x-ui.tooltip>
        @endif
    @endcan
</div>
