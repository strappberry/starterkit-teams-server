@php($defaultValue = $filter->hasFilterDefaultValue() ? (bool) $filter->getFilterDefaultValue() : false)
<div class="flex-cols flex" x-data="booleanFilter($wire, '{{ $filter->getKey() }}', '{{ $tableName }}', '{{ $defaultValue }}')">
    <x-livewire-tables::tools.filter-label :$filter :$filterLayout :$tableName :$isTailwind :$isBootstrap4
        :$isBootstrap5 :$isBootstrap />
    <input id="thisId" type="checkbox" name="switch" class="hidden" :checked="switchOn">

    <button id="{{ $tableName }}-filter-{{ $filter->getKey() }}" x-ref="switchButton" type="button"
        @click="switchOn = ! switchOn; value = (switchOn ? '1' : '0')"
        :class="switchOn ? 'bg-blue-600' : 'bg-neutral-200'"
        class="relative ml-4 inline-flex h-6 w-10 rounded-full py-0.5 focus:outline-none" x-cloak>
        <span :class="switchOn ? 'translate-x-[18px]' : 'translate-x-0.5'"
            class="h-5 w-5 rounded-full bg-white shadow-md duration-200 ease-in-out"></span>
    </button>
    <template x-if="value === '1' || value === '0'">
        <button x-on:click="switchOn = {{ $defaultValue }};" wire:click="resetFilter('{{ $filter->getKey() }}')"
            type="button"
            class="ml-1 inline-flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full text-primary-400 hover:bg-primary-200 hover:text-primary-500 focus:bg-primary-500 focus:text-white focus:outline-none">
            <span class="sr-only">@lang('livewire-tables::Remove filter option')</span>
            <x-heroicon-m-x-mark class="h-6 w-6" />
        </button>
    </template>
</div>
