<div>
    <x-livewire-tables::tools.filter-label :$filter :$filterLayout :$tableName :$isTailwind :$isBootstrap4
        :$isBootstrap5 :$isBootstrap />


    @if ($isTailwind)
        <div class="rounded-md shadow-sm">
            <select multiple {{ $filter->getWireMethod('filterComponents.' . $filter->getKey()) }}
                wire:key="{{ $filter->generateWireKey($tableName, 'multiselectdropdown') }}"
                id="{{ $tableName }}-filter-{{ $filter->getKey() }}@if ($filter->hasCustomPosition()) -{{ $filter->getCustomPosition() }} @endif"
                class="block w-full rounded-md border-gray-300 shadow-sm transition duration-150 ease-in-out focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white">
                @if ($filter->getFirstOption() != '')
                    <option @if ($filter->isEmpty($this)) selected @endif value="all">
                        {{ $filter->getFirstOption() }}</option>
                @endif
                @foreach ($filter->getOptions() as $key => $value)
                    @if (is_iterable($value))
                        <optgroup label="{{ $key }}">
                            @foreach ($value as $optionKey => $optionValue)
                                <option value="{{ $optionKey }}">{{ $optionValue }}</option>
                            @endforeach
                        </optgroup>
                    @else
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    @elseif ($isBootstrap)
        <select multiple {{ $filter->getWireMethod('filterComponents.' . $filter->getKey()) }}
            wire:key="{{ $filter->generateWireKey($tableName, 'multiselectdropdown') }}"
            id="{{ $tableName }}-filter-{{ $filter->getKey() }}@if ($filter->hasCustomPosition()) -{{ $filter->getCustomPosition() }} @endif"
            class="{{ $isBootstrap4 ? 'form-control' : 'form-select' }}">
            @if ($filter->getFirstOption() != '')
                <option @if ($filter->isEmpty($this)) selected @endif value="all">
                    {{ $filter->getFirstOption() }}</option>
            @endif
            @foreach ($filter->getOptions() as $key => $value)
                @if (is_iterable($value))
                    <optgroup label="{{ $key }}">
                        @foreach ($value as $optionKey => $optionValue)
                            <option value="{{ $optionKey }}">{{ $optionValue }}</option>
                        @endforeach
                    </optgroup>
                @else
                    <option value="{{ $key }}">{{ $value }}</option>
                @endif
            @endforeach
        </select>
    @endif
</div>
