<x-guest-layout>
    @include('landing.partials.header')

    <div class="relative" id="home">
        <div aria-hidden="true" class="absolute inset-0 grid grid-cols-2 -space-x-52 opacity-40 dark:opacity-20">
            <div class="from-primary h-56 bg-gradient-to-br to-purple-400 blur-[106px] dark:from-blue-700"></div>
            <div class="h-32 bg-gradient-to-r from-cyan-400 to-sky-300 blur-[106px] dark:to-indigo-600"></div>
        </div>

        <div class="mx-auto max-w-7xl px-6 md:px-12 xl:px-6">
            <div class="relative ml-auto pt-36">
                <div class="mx-auto text-center lg:w-2/3">
                    <h1 class="text-5xl font-bold text-gray-900 dark:text-white md:text-6xl xl:text-7xl">Dando forma a un
                        mundo con
                        <span class="text-primary dark:text-white">imaginación.</span>
                    </h1>
                    <p class="mt-8 text-gray-700 dark:text-gray-300">Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Odio incidunt nam itaque sed eius modi error totam sit illum. Voluptas doloribus
                        asperiores quaerat aperiam. Quidem harum omnis beatae ipsum soluta!</p>

                    <div class="mt-16 flex flex-wrap justify-center gap-x-6 gap-y-4">
                        <a href="#"
                            class="relative flex h-11 w-full items-center justify-center px-6 before:absolute before:inset-0 before:rounded-full before:bg-primary-500 before:transition before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95 sm:w-max">
                            <span class="relative text-base font-semibold text-white">Comenzar</span>
                        </a>

                        <a href="#"
                            class="relative flex h-11 w-full items-center justify-center px-6 before:absolute before:inset-0 before:rounded-full before:border before:border-transparent before:bg-primary-500/10 before:bg-gradient-to-b before:transition before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95 dark:before:border-gray-700 dark:before:bg-gray-800 sm:w-max">
                            <span class="text-primary relative text-base font-semibold dark:text-white">Aprender
                                más</span>
                        </a>
                    </div>

                    <div
                        class="mt-16 hidden justify-between border-y border-gray-100 py-8 dark:border-gray-800 sm:flex">
                        <div class="text-left">
                            <h6 class="text-lg font-semibold text-gray-700 dark:text-white">El precio más bajo</h6>
                            <p class="mt-2 text-gray-500">Algún texto aquí</p>
                        </div>
                        <div class="text-left">
                            <h6 class="text-lg font-semibold text-gray-700 dark:text-white">El más rápido del mercado
                            </h6>
                            <p class="mt-2 text-gray-500">Algún texto aquí</p>
                        </div>
                        <div class="text-left">
                            <h6 class="text-lg font-semibold text-gray-700 dark:text-white">El más querido</h6>
                            <p class="mt-2 text-gray-500">Algún texto aquí</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
