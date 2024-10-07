@props(['item'])

@php
    $class =
        'group flex items-center gap-3 rounded-xl border border-transparent px-4 py-2.5 font-medium text-slate-600 transition hover:bg-slate-100 active:border-slate-200 active:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-900/50 dark:active:border-slate-700/50 dark:active:text-slate-100';

    $iconClass =
        'hi-outline hi-bell inline-block h-6 w-6 text-slate-700 transition group-hover:text-primary-600 dark:text-slate-200';

    $activeRoute = isset($item['active_route']) && $item['active_route'] ? $item['active_route'] : $item['route'];
    $isActive = request()->routeIs($activeRoute);

    if ($isActive) {
        $class =
            'group flex items-center gap-3 rounded-xl border border-transparent bg-slate-100 px-4 py-2.5 font-medium text-slate-900 transition dark:bg-slate-900 dark:text-slate-100';
        $iconClass = 'hi-outline hi-home inline-block h-6 w-6 text-primary-600 dark:text-primary-400 transition';
    }
@endphp

@if (!isset($item['permission']))
    <a href="{{ route($item['route']) }}" {{ $attributes->merge(['class' => $class]) }}>
        @if (isset($item['icon']) && $item['icon'])
            @svg('heroicon-o-' . $item['icon'], $iconClass)
        @endif
        <span class="grow">
            {{ __($item['label']) }}
        </span>
        @if ($isActive)
            <span class="text-primary-500">&bull;</span>
        @endif
    </a>
@elseif (auth()->user()
        ?->hasPermissionTo($item['permission']))
    <a href="{{ route($item['route']) }}" {{ $attributes->merge(['class' => $class]) }}>
        @if (isset($item['icon']) && $item['icon'])
            @svg('heroicon-o-' . $item['icon'], $iconClass)
        @endif
        <span class="grow">
            {{ __($item['label']) }}
        </span>
        @if ($isActive)
            <span class="text-primary-700 dark:text-primary-400">&bull;</span>
        @endif
    </a>
@endif
