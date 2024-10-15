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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />
    <div x-data="{
        mobileSidebarOpen: false,
        desktopSidebarOpen: true,
        darkMode: false,
        userDropdownOpen: false,
        changeTheme() {
            window.toggleDarkMode();
            this.darkMode = !this.darkMode;
        },
    }">
        <!-- Page Container -->
        <div id="page-container"
            class="mx-auto flex min-h-screen w-full min-w-[320px] flex-col bg-gray-200/50 transition-all duration-300 ease-out dark:bg-gray-800 dark:text-gray-200 lg:ps-64"
            x-bind:class="{ 'lg:ps-64': desktopSidebarOpen }">
            <!-- Page Sidebar -->
            <nav id="page-sidebar"
                class="fixed bottom-0 start-0 top-0 z-50 flex h-full w-full flex-col border-transparent bg-white transition-transform duration-300 ease-out ltr:border-r rtl:border-l dark:border-gray-700 dark:bg-gray-800 lg:w-64"
                x-bind:class="{
                    'ltr:-translate-x-full rtl:translate-x-full': !mobileSidebarOpen,
                    'translate-x-0': mobileSidebarOpen,
                    'ltr:lg:-translate-x-full rtl:lg:translate-x-full': !desktopSidebarOpen,
                    'ltr:lg:translate-x-0 rtl:lg:translate-x-0': desktopSidebarOpen,
                }"
                aria-label="Main Sidebar Navigation">
                <!-- Sidebar Header -->
                <div class="flex h-16 w-full flex-none items-center justify-between px-5 shadow-sm">
                    <!-- Brand -->
                    <a href="javascript:void(0)"
                        class="group inline-flex items-center gap-2 font-semibold text-gray-800 hover:text-gray-600 dark:text-gray-200 dark:hover:text-gray-300">
                        <img src="{{ asset('assets/logo.jpg') }}" class="h-10 w-10 rounded-full" alt="App logo">
                        <span>{{ config('app.name') }}</span>
                    </a>
                    <!-- END Brand -->

                    <!-- Extra Actions -->
                    <div class="flex items-center">
                        <!-- Dark Mode Toggle -->
                        <button type="button"
                            class="inline-flex items-center justify-center leading-5 text-gray-800 hover:text-gray-600 focus:outline-none active:text-gray-800 dark:text-gray-200 dark:hover:text-gray-300 dark:active:text-gray-200"
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
                            class="ms-3 inline-flex items-center justify-center leading-5 text-gray-800 hover:text-primary-600 focus:outline-none active:text-primary-800 dark:text-gray-200 dark:hover:text-primary-300 dark:active:text-primary-200 lg:hidden"
                            x-on:click="mobileSidebarOpen = false">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor"
                                class="hi-solid hi-x-mark inline-block h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        <!-- END Close Sidebar on Mobile -->
                    </div>
                    <!-- END Extra Actions -->
                </div>
                <!-- END Sidebar Header -->

                <!-- Sidebar Navigation -->
                <div class="overflow-y-auto">
                    <div class="w-full py-4">
                        <nav class="space-y-1">
                            @foreach (config('dashboard.menu') as $item)
                                {{-- <x-tailtube-nav-item :item="$item" /> --}}
                                <x-second-dashboard-nav-item :item="$item" />
                            @endforeach
                        </nav>
                    </div>
                </div>
                <!-- END Sidebar Navigation -->
            </nav>
            <!-- Page Sidebar -->

            <!-- Page Header -->
            <header id="page-header"
                class="fixed end-0 start-0 top-0 z-30 flex h-16 flex-none items-center bg-white shadow-sm transition-all duration-300 ease-out dark:bg-gray-800 lg:ps-64"
                x-bind:class="{ 'lg:ps-64': desktopSidebarOpen }">
                <div class="mx-auto flex w-full justify-between px-4 lg:px-8">
                    <!-- Left Section -->
                    <div class="flex items-center">
                        <!-- Toggle Sidebar on Mobile -->
                        <div class="me-2 lg:hidden">
                            <button type="button"
                                class="inline-flex items-center justify-center gap-2 rounded border border-gray-300 bg-white px-3 py-2 font-semibold leading-6 text-gray-800 shadow-sm hover:border-gray-300 hover:bg-gray-100 hover:text-gray-800 hover:shadow focus:outline-none focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:border-white active:bg-white active:shadow-none dark:border-gray-700/75 dark:bg-gray-800 dark:text-gray-200 dark:hover:border-gray-700 dark:hover:bg-gray-800 dark:hover:text-gray-200 dark:focus:ring-gray-700 dark:active:border-gray-900 dark:active:bg-gray-900"
                                x-on:click="mobileSidebarOpen = true">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="hi-solid hi-menu-alt-1 inline-block h-5 w-5">
                                    <path fill-rule="evenodd"
                                        d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                        <!-- END Toggle Sidebar on Mobile -->

                        <!-- Toggle Sidebar on Desktop -->
                        <div class="hidden lg:block">
                            <button type="button"
                                class="inline-flex items-center justify-center gap-2 rounded border border-gray-300 bg-white px-3 py-2 font-semibold leading-6 text-gray-800 shadow-sm hover:border-gray-300 hover:bg-gray-100 hover:text-gray-800 hover:shadow focus:outline-none focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:border-white active:bg-white active:shadow-none dark:border-gray-700/75 dark:bg-gray-800 dark:text-gray-200 dark:hover:border-gray-700 dark:hover:bg-gray-800 dark:hover:text-gray-200 dark:focus:ring-gray-700 dark:active:border-gray-900 dark:active:bg-gray-900"
                                x-on:click="desktopSidebarOpen = !desktopSidebarOpen">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="hi-solid hi-menu-alt-1 inline-block h-5 w-5">
                                    <path fill-rule="evenodd"
                                        d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                        <!-- END Toggle Sidebar on Desktop -->
                    </div>
                    <!-- END Left Section -->

                    <!-- Main Section -->
                    <div class="flex items-center">
                        <!-- Brand -->
                        <a href="javascript:void(0)"
                            class="group inline-flex items-center gap-2 font-semibold text-gray-800 hover:text-gray-600 sm:hidden">
                            <img src="{{ asset('assets/logo.jpg') }}" class="inline-block h-10 w-10 rounded-full"
                                alt="App logo">
                        </a>
                        <!-- END Brand -->
                    </div>
                    <!-- END Main Section -->

                    <!-- Right Section -->
                    <div class="flex items-center gap-2">
                        <!-- User Dropdown -->
                        <div class="relative inline-block">
                            <!-- Dropdown Toggle Button -->
                            <button type="button"
                                class="inline-flex items-center justify-center rounded border border-gray-300 bg-white px-3 py-2 text-sm font-semibold leading-5 text-gray-800 shadow-sm hover:border-gray-300 hover:bg-gray-100 hover:text-gray-800 hover:shadow focus:outline-none focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:border-white active:bg-white active:shadow-none dark:border-gray-700/75 dark:bg-gray-800 dark:text-gray-200 dark:hover:border-gray-700 dark:hover:bg-gray-800 dark:hover:text-gray-200 dark:focus:ring-gray-700 dark:active:border-gray-900 dark:active:bg-gray-900"
                                id="tk-dropdown-layouts-user" aria-haspopup="true"
                                x-bind:aria-expanded="userDropdownOpen" x-on:click="userDropdownOpen = true">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="hi-solid hi-user-circle inline-block h-5 w-5 sm:hidden">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-5.5-2.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0zM10 12a5.99 5.99 0 00-4.793 2.39A6.483 6.483 0 0010 16.5a6.483 6.483 0 004.793-2.11A5.99 5.99 0 0010 12z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="hidden sm:inline">{{ auth()->user()->name }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="hi-solid hi-chevron-down ms-1 hidden h-5 w-5 opacity-50 sm:inline-block">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                            <!-- END Dropdown Toggle Button -->

                            <!-- Dropdown -->
                            <div x-cloak x-show="userDropdownOpen"
                                x-transition:enter="transition ease-out duration-150"
                                x-transition:enter-start="opacity-0 scale-75"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-100"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-75"
                                x-on:click.outside="userDropdownOpen = false" role="menu"
                                aria-labelledby="tk-dropdown-layouts-user"
                                class="z-1 absolute end-0 mt-2 w-48 rounded shadow-xl ltr:origin-top-right rtl:origin-top-left">
                                <div
                                    class="divide-y divide-gray-100 rounded bg-white ring-1 ring-black ring-opacity-5 dark:divide-gray-700 dark:bg-gray-800 dark:ring-gray-700">
                                    <div class="space-y-1 p-2">
                                        <a role="menuitem" href="{{ route('profile.show') }}"
                                            class="flex items-center gap-2 rounded px-3 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-700 focus:bg-gray-100 focus:text-gray-700 focus:outline-none dark:text-gray-200 dark:hover:bg-gray-700 dark:hover:text-gray-100 dark:focus:bg-gray-700 dark:focus:text-gray-100">
                                            <span>{{ __('Profile') }}</span>
                                        </a>
                                    </div>
                                    <div class="space-y-1 p-2">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" role="menuitem"
                                                class="flex w-full items-center gap-2 rounded px-3 py-2 text-start text-sm font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-700 focus:bg-gray-100 focus:text-gray-700 focus:outline-none dark:text-gray-200 dark:hover:bg-gray-700 dark:hover:text-gray-100 dark:focus:bg-gray-800 dark:focus:text-gray-100">
                                                <span>{{ __('Log Out') }}</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- END Dropdown -->
                        </div>
                        <!-- END User Dropdown -->
                    </div>
                    <!-- END Right Section -->
                </div>
            </header>
            <!-- END Page Header -->

            <!-- Page Content -->
            <main id="page-content" class="flex max-w-full flex-auto flex-col pt-16">
                <div class="mx-auto w-full p-4 lg:p-8">
                    {{ $slot }}
                </div>
            </main>
            <!-- END Page Content -->

            <!-- Page Footer -->
            <footer id="page-footer" class="flex grow-0 items-center border-t border-gray-200 dark:border-gray-700">
                <div
                    class="container mx-auto flex flex-col space-y-2 px-4 py-3 text-center text-sm font-medium text-gray-500 md:flex-row md:justify-between md:space-y-0 md:text-start lg:px-8">
                    <div>
                        <span class="text-xs font-semibold">
                            {{ config('app.version.semantic') }}
                            (
                            {{ config('app.version.hash') }}
                            {{ config('app.version.last_update') }}
                            )
                        </span>
                    </div>
                    <div class="inline-flex items-center justify-center">
                        <span>{{ __('Desarrollado con') }}</span><svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"
                            class="mx-1 h-4 w-4 text-red-600">
                            <path
                                d="M9.653 16.915l-.005-.003-.019-.01a20.759 20.759 0 01-1.162-.682 22.045 22.045 0 01-2.582-1.9C4.045 12.733 2 10.352 2 7.5a4.5 4.5 0 018-2.828A4.5 4.5 0 0118 7.5c0 2.852-2.044 5.233-3.885 6.82a22.049 22.049 0 01-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 01-.69.001l-.002-.001z">
                            </path>
                        </svg>
                        <span>
                            <a class="font-medium text-primary-600 transition hover:text-primary-700 dark:text-primary-400 dark:hover:text-primary-300"
                                href="https://strappberry.com" target="_blank">Strappberry</a></span>
                    </div>
                </div>
            </footer>
            <!-- END Page Footer -->
        </div>
        <!-- END Page Container -->
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>
