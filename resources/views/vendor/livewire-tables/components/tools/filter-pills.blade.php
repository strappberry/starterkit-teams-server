@aware(['component', 'tableName', 'isTailwind', 'isBootstrap', 'isBootstrap4', 'isBootstrap5'])

@if ($this->filtersAreEnabled() && $this->filterPillsAreEnabled() && $this->hasAppliedVisibleFiltersForPills())
    <div>
        <div @class([
            'mb-4 px-4 md:p-0' => $isTailwind,
            'mb-3' => $isBootstrap,
        ]) x-cloak x-show="!currentlyReorderingStatus">
            <small @class([
                'text-gray-700 dark:text-white' => $isTailwind,
                '' => $isBootstrap,
            ])>
                @lang('livewire-tables::Applied Filters'):
            </small>

            @foreach ($this->getAppliedFiltersWithValues() as $filterSelectName => $value)
                @php($filter = $this->getFilterByKey($filterSelectName))

                @continue(is_null($filter))
                @continue($filter->isHiddenFromPills())

                @if ($filter->hasCustomPillBlade())
                    @include($filter->getCustomPillBlade(), ['filter' => $filter])
                @else
                    <span wire:key="{{ $tableName }}-filter-pill-{{ $filter->getKey() }}"
                        @class([
                            'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-primary-100 text-primary-800 capitalize dark:bg-primary-200 dark:text-primary-900' => $isTailwind,
                            'badge badge-pill badge-info d-inline-flex align-items-center' => $isBootstrap4,
                            'badge rounded-pill bg-info d-inline-flex align-items-center' => $isBootstrap5,
                        ])>
                        {{ $filter->getFilterPillTitle() }}:
                        @php($filterPillValue = $filter->getFilterPillValue($value))
                        @php($separator = method_exists($filter, 'getPillsSeparator') ? $filter->getPillsSeparator() : ', ')

                        @if (is_array($filterPillValue) && !empty($filterPillValue))
                            @foreach ($filterPillValue as $filterPillArrayValue)
                                {{ $filterPillArrayValue }}{!! $separator !!}
                            @endforeach
                        @else
                            {{ $filterPillValue }}
                        @endif

                        @if ($isTailwind)
                            <button wire:click="resetFilter('{{ $filter->getKey() }}')" type="button"
                                class="ml-0.5 inline-flex h-4 w-4 flex-shrink-0 items-center justify-center rounded-full text-primary-400 hover:bg-primary-200 hover:text-primary-500 focus:bg-primary-500 focus:text-white focus:outline-none">
                                <span class="sr-only">@lang('livewire-tables::Remove filter option')</span>
                                <x-heroicon-m-x-mark class="h-full" />
                            </button>
                        @else
                            <a href="#" wire:click="resetFilter('{{ $filter->getKey() }}')"
                                @class([
                                    'text-white ml-2' => $isBootstrap,
                                ])>
                                <span @class([
                                    'sr-only' => $isBootstrap4,
                                    'visually-hidden' => $isBootstrap5,
                                ])>
                                    @lang('livewire-tables::Remove filter option')
                                </span>
                                <x-heroicon-m-x-mark class="laravel-livewire-tables-btn-tiny" />
                            </a>
                        @endif
                    </span>
                @endif
            @endforeach

            @if ($isTailwind)
                <button wire:click.prevent="setFilterDefaults" class="focus:outline-none active:outline-none">
                    <span
                        class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800 dark:bg-gray-200 dark:text-gray-900">
                        @lang('livewire-tables::Clear')
                    </span>
                </button>
            @else
                <a href="#" wire:click.prevent="setFilterDefaults" @class([
                    'badge badge-pill badge-light' => $isBootstrap4,
                    'badge rounded-pill bg-light text-dark text-decoration-none' => $isBootstrap5,
                ])>
                    @lang('livewire-tables::Clear')
                </a>
            @endif
        </div>
    </div>
@endif
