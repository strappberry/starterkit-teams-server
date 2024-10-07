@aware(['component', 'tableName', 'isTailwind', 'isBootstrap', 'isBootstrap4', 'isBootstrap5'])
@if ($isTailwind)
    <div
        class="@if ($component->getColumnSelectIsHiddenOnMobile()) hidden sm:block @elseif ($component->getColumnSelectIsHiddenOnTablet()) hidden md:block @endif mb-4 w-full md:mb-0 md:ml-2 md:w-auto">
        <div x-data="{ open: false, childElementOpen: false }" @keydown.window.escape="if (!childElementOpen) { open = false }"
            x-on:click.away="if (!childElementOpen) { open = false }"
            class="relative inline-block w-full text-left md:w-auto" wire:key="{{ $tableName }}-column-select-button">
            <div>
                <span class="rounded-md shadow-sm">
                    <button x-on:click="open = !open" type="button"
                        class="inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600"
                        aria-haspopup="true" x-bind:aria-expanded="open" aria-expanded="true">
                        @lang('livewire-tables::Columns')

                        <x-heroicon-m-chevron-down class="-mr-1 ml-2 h-5 w-5" />
                    </button>
                </span>
            </div>

            <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                class="absolute right-0 z-50 mt-2 w-full origin-top-right divide-y divide-gray-100 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none md:w-48">
                <div class="shadow-xs rounded-md bg-white dark:bg-gray-700 dark:text-white">
                    <div class="p-2" role="menu" aria-orientation="vertical" aria-labelledby="column-select-menu">
                        <div wire:key="{{ $tableName }}-columnSelect-selectAll-{{ rand(0, 1000) }}">
                            <label wire:loading.attr="disabled"
                                class="inline-flex items-center px-2 py-1 disabled:cursor-wait disabled:opacity-50">
                                <input
                                    class="rounded border-gray-300 text-primary-600 shadow-sm transition duration-150 ease-in-out focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-wait disabled:opacity-50 dark:border-gray-600 dark:bg-gray-900 dark:text-white dark:hover:bg-gray-600 dark:focus:bg-gray-600"
                                    wire:loading.attr="disabled" type="checkbox" @checked($component->getSelectableSelectedColumns()->count() == $component->getSelectableColumns()->count())
                                    @if ($component->getSelectableSelectedColumns()->count() == $component->getSelectableColumns()->count()) wire:click="deselectAllColumns" @else wire:click="selectAllColumns" @endif>
                                <span class="ml-2">@lang('livewire-tables::All Columns')</span>
                            </label>
                        </div>

                        @foreach ($component->getColumnsForColumnSelect() as $columnSlug => $columnTitle)
                            <div wire:key="{{ $tableName }}-columnSelect-{{ $loop->index }}">
                                <label wire:loading.attr="disabled" wire:target="selectedColumns"
                                    class="inline-flex items-center px-2 py-1 disabled:cursor-wait disabled:opacity-50">
                                    <input
                                        class="rounded border-gray-300 text-primary-600 shadow-sm transition duration-150 ease-in-out focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-wait disabled:opacity-50 dark:border-gray-600 dark:bg-gray-900 dark:text-white dark:hover:bg-gray-600 dark:focus:bg-gray-600"
                                        wire:model.live="selectedColumns" wire:target="selectedColumns"
                                        wire:loading.attr="disabled" type="checkbox" value="{{ $columnSlug }}" />
                                    <span class="ml-2">{{ $columnTitle }}</span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif ($isBootstrap)
    <div @class([
        'd-none d-sm mb-3 mb-md-0 pl-0 pl-md-2' =>
            $component->getColumnSelectIsHiddenOnMobile() && $isBootstrap4,
        'd-none d-md-block mb-3 mb-md-0 pl-0 pl-md-2' =>
            $component->getColumnSelectIsHiddenOnTablet() && $isBootstrap4,
        'd-none d-sm-block mb-3 mb-md-0 md-0 ms-md-2' =>
            $component->getColumnSelectIsHiddenOnMobile() && $isBootstrap5,
        'd-none d-md-block mb-3 mb-md-0 md-0 ms-md-2' =>
            $component->getColumnSelectIsHiddenOnTablet() && $isBootstrap5,
    ])>
        <div x-data="{ open: false, childElementOpen: false }" x-on:keydown.escape.stop="if (!childElementOpen) { open = false }"
            x-on:mousedown.away="if (!childElementOpen) { open = false }" @class([
                'dropdown d-block d-md-inline' => $isBootstrap,
            ])
            wire:key="{{ $tableName }}-column-select-button">
            <button x-on:click="open = !open" @class([
                'btn dropdown-toggle d-block w-100 d-md-inline' => $isBootstrap,
            ]) type="button"
                id="{{ $tableName }}-columnSelect" aria-haspopup="true" x-bind:aria-expanded="open">
                @lang('livewire-tables::Columns')
            </button>

            <div x-bind:class="{ 'show': open }" @class([
                'dropdown-menu dropdown-menu-right w-100 mt-0 mt-md-3' => $isBootstrap4,
                'dropdown-menu dropdown-menu-end w-100' => $isBootstrap5,
            ])
                aria-labelledby="columnSelect-{{ $tableName }}">
                @if ($isBootstrap4)
                    <div wire:key="{{ $tableName }}-columnSelect-selectAll-{{ rand(0, 1000) }}">
                        <label wire:loading.attr="disabled" class="mb-1 px-2">
                            <input wire:loading.attr="disabled" type="checkbox"
                                @if ($component->getSelectableSelectedColumns()->count() == $component->getSelectableColumns()->count()) checked wire:click="deselectAllColumns" @else unchecked wire:click="selectAllColumns" @endif />

                            <span class="ml-2">@lang('livewire-tables::All Columns')</span>


                        </label>
                    </div>
                @elseif($isBootstrap5)
                    <div class="form-check ms-2"
                        wire:key="{{ $tableName }}-columnSelect-selectAll-{{ rand(0, 1000) }}">
                        <input wire:loading.attr="disabled" type="checkbox" class="form-check-input"
                            @if ($component->getSelectableSelectedColumns()->count() == $component->getSelectableColumns()->count()) checked wire:click="deselectAllColumns" @else unchecked wire:click="selectAllColumns" @endif />

                        <label wire:loading.attr="disabled" class="form-check-label">
                            @lang('livewire-tables::All Columns')
                        </label>
                    </div>
                @endif

                @foreach ($component->getColumnsForColumnSelect() as $columnSlug => $columnTitle)
                    <div wire:key="{{ $tableName }}-columnSelect-{{ $loop->index }}" @class([
                        'form-check ms-2' => $isBootstrap5,
                    ])>
                        @if ($isBootstrap4)
                            <label wire:loading.attr="disabled" wire:target="selectedColumns"
                                class="{{ $loop->last ? 'mb-0' : 'mb-1' }} px-2">
                                <input wire:model.live="selectedColumns" wire:target="selectedColumns"
                                    wire:loading.attr="disabled" type="checkbox" value="{{ $columnSlug }}" />
                                <span class="ml-2">
                                    {{ $columnTitle }}
                                </span>
                            </label>
                        @elseif($isBootstrap5)
                            <input wire:model.live="selectedColumns" wire:target="selectedColumns"
                                wire:loading.attr="disabled" type="checkbox" class="form-check-input"
                                value="{{ $columnSlug }}" />
                            <label wire:loading.attr="disabled" wire:target="selectedColumns"
                                class="{{ $loop->last ? 'mb-0' : 'mb-1' }} form-check-label">
                                {{ $columnTitle }}
                            </label>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endif
