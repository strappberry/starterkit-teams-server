<form wire:submit="save">
    <x-card class="space-y-4 p-4">
        <h1 class="text-center text-lg font-semibold">
            {{ $user ? __('panel.usuarios.editar') : __('panel.usuarios.agregar') }}
        </h1>

        <div>
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model="form.name" />
            <x-input-error for="form.name" class="mt-2" />
        </div>

        <div>
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="text" class="mt-1 block w-full" wire:model="form.email" />
            <x-input-error for="form.email" class="mt-2" />
        </div>

        <div>
            <x-label for="password" value="{{ __('Password') }}" />
            <x-input id="password" type="password" class="mt-1 block w-full" wire:model="form.password" />
            <x-input-error for="form.password" class="mt-2" />
        </div>

        <div>
            <x-label for="role" value="{{ __('Role') }}" />
            <x-select wire:model.live="form.role" class="mt-1 block w-full">
                <option value="">-- {{ __('panel.usuarios.seleccione_role') }} --</option>
                @foreach ($roles as $option)
                    <option value="{{ $option->value }}">
                        {{ $option->description() }}
                    </option>
                @endforeach
            </x-select>
            <x-input-error for="form.role" class="mt-2" />
        </div>

        <div>
            <x-label value="{{ __('panel.usuarios.permisos') }}" />
            <div class="mt-1 grid grid-cols-1 gap-4 md:grid-cols-2">
                @foreach ($this->permissions as $module => $permissions)
                    <div>
                        <p class="mb-1 cursor-pointer text-sm font-semibold"
                            wire:click="setPermissionsForModule('{{ $module }}')">
                            {{ ucfirst($module) }}
                        </p>

                        @foreach ($permissions as $permission)
                            <label class="flex items-center">
                                <x-checkbox wire:model="form.permissions" :value="$permission" />
                                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">
                                    {{ ucfirst(__($permission)) }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>


        <div class="text-right">
            <x-button>
                {{ __('panel.general.guardar') }}
            </x-button>
        </div>
    </x-card>
</form>
