<form wire:submit="save">
    <x-card class="space-y-4 p-4">
        <h1 class="text-center text-lg font-semibold">
            {{ $team ? __('panel.equipos.editar') : __('panel.equipos.agregar') }}
        </h1>

        <div>
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model="form.name" />
            <x-input-error for="form.name" class="mt-2" />
        </div>

        @if (!$team)
            <div class="border rounded p-4 space-y-4">
                <div>
                    <x-label for="name" value="{{ __('panel.general.administrador') }}" />
                </div>

                <div>
                    <x-label for="admin_name" value="{{ __('panel.general.nombre') }}" />
                    <x-input id="admin_name" type="text" class="mt-1 block w-full" wire:model="form.admin_name" />
                    <x-input-error for="form.admin_name" class="mt-2" />
                </div>

                <div>
                    <x-label for="admin_email" value="{{ __('panel.general.email') }}" />
                    <x-input id="admin_email" type="text" class="mt-1 block w-full" wire:model="form.admin_email" />
                    <x-input-error for="form.admin_email" class="mt-2" />
                </div>

                <div>
                    <x-label for="admin_password" value="{{ __('panel.general.contrasena') }}" />
                    <x-input id="admin_password" type="password" class="mt-1 block w-full"
                        wire:model="form.admin_password" />
                    <x-input-error for="form.admin_password" class="mt-2" />
                </div>
            </div>
        @else
            <div>
                <x-label for="name" value="{{ __('panel.general.administrador') }}" />
                <strong>
                    {{ $team->owner->name }}
                </strong>
                <x-ui.badge>
                    {{ $team->owner->email }}
                </x-ui.badge>
            </div>
        @endif

        <div class="text-right">
            <x-button>
                {{ __('panel.general.guardar') }}
            </x-button>
        </div>
    </x-card>
</form>
