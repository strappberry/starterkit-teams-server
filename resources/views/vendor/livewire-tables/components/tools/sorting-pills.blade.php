@aware(['component', 'tableName', 'isTailwind', 'isBootstrap', 'isBootstrap4', 'isBootstrap5'])

@if ($this->isTailwind)
    <div>
        @if ($this->sortingPillsAreEnabled() && $this->hasSorts())
            <div class="mb-4 px-4 md:p-0" x-cloak x-show="!currentlyReorderingStatus">
                <small class="text-gray-700 dark:text-white">@lang('livewire-tables::Applied Sorting'):</small>

                @foreach ($this->getSorts() as $columnSelectName => $direction)
                    @php($column = $this->getColumnBySelectName($columnSelectName) ?? $this->getColumnBySlug($columnSelectName))

                    @continue(is_null($column))
                    @continue($column->isHidden())
                    @continue($this->columnSelectIsEnabled() && !$this->columnSelectIsEnabledForColumn($column))

                    <span wire:key="{{ $tableName }}-sorting-pill-{{ $columnSelectName }}"
                        class="inline-flex items-center rounded-full bg-primary-100 px-2.5 py-0.5 text-xs font-medium capitalize leading-4 text-primary-800 dark:bg-primary-200 dark:text-primary-900">
                        {{ $column->getSortingPillTitle() }}:
                        {{ $column->getSortingPillDirectionLabel($direction, $this->getDefaultSortingLabelAsc, $this->getDefaultSortingLabelDesc) }}

                        <button wire:click="clearSort('{{ $columnSelectName }}')" type="button"
                            class="ml-0.5 inline-flex h-4 w-4 flex-shrink-0 items-center justify-center rounded-full text-primary-400 hover:bg-primary-200 hover:text-primary-500 focus:bg-primary-500 focus:text-white focus:outline-none">
                            <span class="sr-only">@lang('livewire-tables::Remove sort option')</span>
                            <x-heroicon-m-x-mark class="h-3 w-3" />
                        </button>
                    </span>
                @endforeach

                <button wire:click.prevent="clearSorts" class="focus:outline-none active:outline-none">
                    <span
                        class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800 dark:bg-gray-200 dark:text-gray-900">
                        @lang('livewire-tables::Clear')
                    </span>
                </button>
            </div>
        @endif
    </div>
@elseif ($this->isBootstrap4)
    <div>
        @if ($this->sortingPillsAreEnabled() && $this->hasSorts())
            <div class="mb-3" x-cloak x-show="!currentlyReorderingStatus">
                <small>@lang('livewire-tables::Applied Sorting'):</small>

                @foreach ($this->getSorts() as $columnSelectName => $direction)
                    @php($column = $this->getColumnBySelectName($columnSelectName) ?? $this->getColumnBySlug($columnSelectName))

                    @continue(is_null($column))
                    @continue($column->isHidden())
                    @continue($this->columnSelectIsEnabled() && !$this->columnSelectIsEnabledForColumn($column))

                    <span wire:key="{{ $tableName . '-sorting-pill-' . $columnSelectName }}"
                        class="badge badge-pill badge-info d-inline-flex align-items-center">
                        {{ $column->getSortingPillTitle() }}:
                        {{ $column->getSortingPillDirectionLabel($direction, $this->getDefaultSortingLabelAsc, $this->getDefaultSortingLabelDesc) }}

                        <a href="#" wire:click="clearSort('{{ $columnSelectName }}')" class="ml-2 text-white">
                            <span class="sr-only">@lang('livewire-tables::Remove sort option')</span>
                            <x-heroicon-m-x-mark class="laravel-livewire-tables-btn-smaller" />
                        </a>
                    </span>
                @endforeach

                <a href="#" wire:click.prevent="clearSorts" class="badge badge-pill badge-light">
                    @lang('livewire-tables::Clear')
                </a>
            </div>
        @endif
    </div>
@elseif ($this->isBootstrap5)
    <div>
        @if ($this->sortingPillsAreEnabled() && $this->hasSorts())
            <div class="mb-3" x-cloak x-show="!currentlyReorderingStatus">
                <small>@lang('livewire-tables::Applied Sorting'):</small>

                @foreach ($this->getSorts() as $columnSelectName => $direction)
                    @php($column = $this->getColumnBySelectName($columnSelectName) ?? $this->getColumnBySlug($columnSelectName))

                    @continue(is_null($column))
                    @continue($column->isHidden())
                    @continue($this->columnSelectIsEnabled() && !$this->columnSelectIsEnabledForColumn($column))

                    <span wire:key="{{ $tableName }}-sorting-pill-{{ $columnSelectName }}"
                        class="badge rounded-pill bg-info d-inline-flex align-items-center">
                        {{ $column->getSortingPillTitle() }}:
                        {{ $column->getSortingPillDirectionLabel($direction, $this->getDefaultSortingLabelAsc, $this->getDefaultSortingLabelDesc) }}

                        <a href="#" wire:click="clearSort('{{ $columnSelectName }}')" class="ms-2 text-white">
                            <span class="visually-hidden">@lang('livewire-tables::Remove sort option')</span>
                            <x-heroicon-m-x-mark class="laravel-livewire-tables-btn-smaller" />
                        </a>
                    </span>
                @endforeach

                <a href="#" wire:click.prevent="clearSorts"
                    class="badge rounded-pill bg-light text-dark text-decoration-none">
                    @lang('livewire-tables::Clear')
                </a>
            </div>
        @endif
    </div>
@endif
