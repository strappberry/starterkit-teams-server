<x-first-dashboard>
    {{ Breadcrumbs::render('dashboard.settings.index') }}

    @if (config('stripe.subscriptions_enabled'))
        @if (!auth()->user()->subscribed())
            <div class="grid gap-4 grid-cols-1 md:grid-cols-3">
                @foreach (config('stripe.subscriptions') as $slug => $data)
                    <x-pricing-card :slug="$slug" :data="$data" />
                @endforeach
            </div>
        @endif

        @if (auth()->user()->subscribed())
            <x-ts-card :personalize="[
                'wrapper.first' => 'my-4',
                'wrapper.second' =>
                    'dark:bg-dark-800 flex w-full flex-col rounded-xl bg-white border border-transparent dark:border-dark-700',
            ]">
                <div>
                    <a href="{{ route('dashboard.settings.redirectToBilling') }}"
                        class="text-primary-600 dark:text-primary-300" target="_blank">
                        Administrar suscripción
                    </a>
                </div>
            </x-ts-card>
        @endif
    @endif
</x-first-dashboard>
