<x-ts-card class="space-y-4" :personalize="[
    'wrapper.second' =>
        'dark:bg-dark-800 flex w-full flex-col rounded-xl bg-white border border-transparent dark:border-dark-700',
]">
    <header>
        <h2 class="text-center text-lg font-bold">
            {{ $data['name'] }}
        </h2>
    </header>

    <article>
        <div class="text-center text-2xl font-bold">
            {{ $data['display_price'] }} / {{ __('panel.general.mes') }}
        </div>
    </article>

    <article>
        <ul class="list-inside text-center">
            @foreach ($data['features'] as $feature)
                <li>
                    {{ $feature }}
                </li>
            @endforeach
        </ul>
    </article>

    <article>
        <x-ts-button color="primary" class="w-full" href="{{ route('dashboard.settings.redirect-to-subscribe', $slug) }}">
            {{ __('Subscribe') }}
        </x-ts-button>
    </article>
</x-ts-card>
