<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <tallstackui:script />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />
    <x-ts-dialog />
    <x-ts-toast />

    <div x-data="{
        mobileSidebarOpen: false,
        darkMode: false,
        changeTheme() {
            window.toggleDarkMode();
            this.darkMode = !this.darkMode;
        }
    }">
        <!-- Page Container -->
        <div id="page-container"
            class="mx-auto flex min-h-screen w-full min-w-[320px] flex-col bg-gray-200/60 dark:bg-slate-900 dark:text-slate-200 lg:ps-64">
            <!-- Page Sidebar -->
            <nav id="page-sidebar"
                class="dark:lg:border-primary-700/15 fixed bottom-0 start-0 top-0 z-40 flex h-full w-80 flex-col bg-white transition-transform duration-500 ease-out dark:bg-slate-800 lg:w-64 lg:translate-x-0 lg:border-primary-900/10 ltr:lg:translate-x-0 ltr:lg:border-r-4 rtl:lg:translate-x-0 rtl:lg:border-l-4"
                x-bind:class="{
                    'ltr:-translate-x-full rtl:translate-x-full': !mobileSidebarOpen,
                    'translate-x-0': mobileSidebarOpen,
                }"
                aria-label="Main Sidebar Navigation" x-cloak>
                <!-- Sidebar Header -->
                <div class="flex h-20 w-full flex-none items-center justify-between pe-4 ps-8">
                    <!-- Brand -->
                    <a href="javascript:void(0)"
                        class="inline-flex items-center gap-2 text-lg font-semibold tracking-wide text-slate-800 transition hover:opacity-75 active:opacity-100 dark:text-slate-200">
                        <img src="{{ asset('assets/logo.jpg') }}" class="h-12 w-12 rounded-full" alt="App logo">
                        <span>
                            <span class="text-primary-600 dark:text-primary-500">
                                {{ config('app.name') }}
                            </span>
                        </span>
                    </a>
                    <!-- END Brand -->

                    <!-- Extra Actions -->
                    <div class="flex items-center">
                        <!-- Dark Mode Toggle -->
                        <button type="button"
                            class="flex h-10 w-10 items-center justify-center text-slate-400 hover:text-slate-600 active:text-slate-400"
                            x-on:click="changeTheme()">
                            <svg x-show="!darkMode" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="hi-outline hi-moon inline-block h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
                            </svg>
                            <svg x-cloak x-show="darkMode" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="hi-outline hi-sun inline-block h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                            </svg>
                        </button>
                        <!-- END Dark Mode Toggle -->

                        <!-- Close Sidebar on Mobile -->
                        <button type="button"
                            class="flex h-10 w-10 items-center justify-center text-slate-400 hover:text-slate-600 active:text-slate-400 lg:hidden"
                            x-on:click="mobileSidebarOpen = false">
                            <svg class="hi-solid hi-x -mx-1 inline-block h-5 w-5" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <!-- END Close Sidebar on Mobile -->
                    </div>
                    <!-- END Extra Actions -->
                </div>
                <!-- END Sidebar Header -->

                <!-- Main Navigation -->
                <div class="w-full grow space-y-1.5 overflow-auto p-4">
                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                        <x-dashboard-team-selector />
                    @endif
                    @foreach (config('dashboard.menu') as $item)
                        <x-first-dashboard-nav-item :item="$item" />
                    @endforeach
                </div>
                <!-- END Main Navigation -->

                <!-- Sub Navigation -->
                <div class="w-full flex-none space-y-3 p-4">
                    <div x-data="{
                        dropdownOpen: false,
                        toggleDropdown() {
                            this.dropdownOpen = !this.dropdownOpen;
                        }
                    }">
                        <button @click="toggleDropdown()"
                            class="group flex w-full items-center gap-3 rounded-xl border border-transparent px-4 py-2.5 font-semibold text-slate-600 transition hover:bg-slate-100 active:border-slate-200 active:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-900/50 dark:active:border-slate-700/50 dark:active:text-slate-100">
                            <img src="{{ auth()->user()->profile_photo_url }}" alt="User Avatar"
                                class="inline-block h-10 w-10 rounded-full" />
                            <div class="grow text-left leading-5">
                                <span class="text-sm">
                                    {{ auth()->user()->name }}
                                </span>
                                {{-- <span class="text-xs font-medium opacity-75">@john.smith256</span> --}}
                            </div>
                            @svg('heroicon-o-ellipsis-horizontal', 'hi-solid hi-dots-horizontal inline-block h-5 w-5')
                        </button>
                        <div x-show="dropdownOpen" @click.away="dropdownOpen=false"
                            x-transition:enter="ease-out duration-200" x-transition:enter-start="-translate-y-2"
                            x-transition:enter-end="translate-y-0"
                            class="absolute bottom-[60px] left-1/2 z-40 mt-12 w-56 -translate-x-1/2" x-cloak>
                            <div
                                class="mt-1 rounded-md border border-gray-200 bg-white p-1 text-neutral-700 dark:border-gray-500 dark:bg-gray-800">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdownDefaultButton">
                                    <li>
                                        <a href="{{ route('profile.show') }}"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            {{ __('Profile') }}
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="block w-full px-4 py-2 text-left hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                {{ __('Log out') }}
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="text-center text-xs text-gray-600">
                        {{ config('app.version.semantic') }}
                        ({{ config('app.version.hash') }}
                        {{ config('app.version.last_update') }})
                    </div>
                </div>
                <!-- END Sub Navigation -->
            </nav>
            <!-- Page Sidebar -->

            <!-- Page Header -->
            <header id="page-header"
                class="fixed end-0 start-0 top-0 z-30 flex h-20 flex-none items-center bg-white shadow-sm dark:bg-slate-800 lg:hidden">
                <div class="container mx-auto flex justify-between px-4 lg:px-8 xl:max-w-5xl">
                    <!-- Left Section -->
                    <div class="flex items-center gap-2">
                        <!-- Toggle Sidebar on Mobile -->
                        <button type="button"
                            class="inline-flex items-center justify-center gap-2 rounded border border-slate-300 bg-white px-2 py-1.5 font-semibold leading-6 text-slate-800 shadow-sm hover:border-slate-300 hover:bg-slate-100 hover:text-slate-800 hover:shadow focus:outline-none focus:ring focus:ring-slate-500 focus:ring-opacity-25 active:border-white active:bg-white active:shadow-none dark:border-slate-700/75 dark:bg-slate-900 dark:text-slate-200 dark:hover:border-slate-700 dark:hover:bg-slate-800 dark:hover:text-slate-200 dark:focus:ring-slate-700 dark:active:border-slate-900 dark:active:bg-slate-900"
                            x-on:click="mobileSidebarOpen = true">
                            <svg class="hi-solid hi-menu-alt-1 inline-block h-5 w-5" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <!-- END Toggle Sidebar on Mobile -->
                    </div>
                    <!-- END Left Section -->

                    <!-- Middle Section -->
                    <div class="flex items-center gap-2">
                        <!-- Brand -->
                        <a href="javascript:void(0)"
                            class="inline-flex items-center gap-2 text-lg font-bold tracking-wide text-slate-800 transition hover:opacity-75 active:opacity-100 dark:text-slate-100">
                            <img src="{{ asset('assets/logo.jpg') }}"
                                class="hi-mini hi-bolt inline h-9 w-9 rounded-full" alt="App logo">
                            <span>{{ config('app.name') }}</span>
                        </a>
                        <!-- END Brand -->
                    </div>
                    <!-- END Middle Section -->

                    <!-- Right Section -->
                    <div class="flex items-center gap-2">
                        <!-- Settings -->
                        <a href="{{ route('profile.show') }}"
                            class="inline-flex items-center justify-center gap-2 rounded border border-slate-300 bg-white px-2 py-1.5 font-semibold leading-6 text-slate-800 shadow-sm hover:border-slate-300 hover:bg-slate-100 hover:text-slate-800 hover:shadow focus:outline-none focus:ring focus:ring-slate-500 focus:ring-opacity-25 active:border-white active:bg-white active:shadow-none dark:border-slate-700/75 dark:bg-slate-900 dark:text-slate-200 dark:hover:border-slate-700 dark:hover:bg-slate-800 dark:hover:text-slate-200 dark:focus:ring-slate-700 dark:active:border-slate-900 dark:active:bg-slate-900">
                            <svg class="hi-solid hi-user-circle inline-block h-5 w-5" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <!-- END Toggle Sidebar on Mobile -->
                    </div>
                    <!-- END Right Section -->
                </div>
            </header>
            <!-- END Page Header -->

            <!-- Page Content -->
            <main id="page-content" class="flex max-w-full flex-auto flex-col pt-20 lg:pt-0">
                <!-- Page Section -->
                <div class="mx-auto w-full p-4 lg:p-8">
                    {{ $slot }}
                </div>
                <!-- END Page Section -->
            </main>
            <!-- END Page Content -->
        </div>
        <!-- END Page Container -->
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>
