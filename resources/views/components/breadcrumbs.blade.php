@unless ($breadcrumbs->isEmpty())
    <nav class="container mx-auto mb-4">
        <ol class="px-4 py-2 rounded flex flex-wrap bg-primary-500/10 dark:bg-primary-100/10 text-sm text-gray-800">
            @foreach ($breadcrumbs as $breadcrumb)
                @if ($breadcrumb->url && !$loop->last)
                    <li>
                        <a href="{{ $breadcrumb->url }}"
                            class="text-primary-600 dark:text-primary-200 hover:text-primary-900 hover:underline focus:text-primary-900 focus:underline">
                            {{ $breadcrumb->title }}
                        </a>
                    </li>
                @else
                    <li class="text-primary-500 dark:text-primary-100 font-semibold px-2">
                        {{ $breadcrumb->title }}
                    </li>
                @endif

                @unless ($loop->last)
                    <li class="text-gray-500 dark:text-primary-100 font-semibold px-2">
                        /
                    </li>
                @endif
                @endforeach
            </ol>
        </nav>
    @endunless
