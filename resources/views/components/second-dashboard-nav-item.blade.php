@props(['item'])

@php
    $class =
        'group flex items-center gap-2 px-5 py-0.5 text-sm font-medium text-gray-700 hover:bg-primary-50 hover:text-primary-900 active:bg-gray-50 dark:text-gray-100 dark:hover:bg-primary-900 dark:hover:text-primary-100';
    $iconClass =
        'hi-outline hi-globe-americas inline-block h-6 w-6 text-gray-400 group-hover:text-primary-600 dark:group-hover:text-primary-300';

    $activeRoute = isset($item['active_route']) && $item['active_route'] ? $item['active_route'] : $item['route'];
    $isActive = request()->routeIs($activeRoute);

    if ($isActive) {
        $class =
            'group flex items-center gap-2 border-r-4 border-primary-400 bg-primary-50 px-5 py-0.5 text-sm font-medium text-primary-900 dark:bg-primary-900 dark:text-primary-100';
        $iconClass = 'hi-outline hi-home inline-block h-6 w-6 text-primary-600 dark:text-primary-100';
    }
@endphp

@if (!isset($item['permission']))
    <a href="{{ route($item['route']) }}" {{ $attributes->merge(['class' => $class]) }}>
        @if (isset($item['icon']) && $item['icon'])
            <span class="flex flex-none items-center opacity-75">
                @svg('heroicon-o-' . $item['icon'], $iconClass)
            </span>
        @endif
        <span class="grow py-2">
            {{ __($item['label']) }}
        </span>
    </a>
@elseif (auth()->user()
        ?->hasPermissionTo($item['permission']))
    <a href="{{ route($item['route']) }}" {{ $attributes->merge(['class' => $class]) }}>
        @if (isset($item['icon']) && $item['icon'])
            <span class="flex flex-none items-center opacity-75">
                @svg('heroicon-o-' . $item['icon'], $iconClass)
            </span>
        @endif
        <span class="grow py-2">
            {{ __($item['label']) }}
        </span>
    </a>
@endif
