<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-secondary-50">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;700&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased h-full" x-data="{ sidebarOpen: false }">

    <div class="min-h-full">
        <!-- Mobile sidebar -->
        <div x-show="sidebarOpen" class="relative z-50 lg:hidden" role="dialog" aria-modal="true">
            <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" class="fixed inset-0 bg-secondary-900/80 backdrop-blur-sm"></div>

            <div class="fixed inset-0 flex">
                <div x-show="sidebarOpen" x-transition:enter="transition ease-in-out duration-300 transform"
                    x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transition ease-in-out duration-300 transform"
                    x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                    class="relative mr-16 flex w-full max-w-xs flex-1">

                    <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-white px-6 pb-4">
                        <div class="flex h-16 shrink-0 items-center">
                            <span class="font-display font-bold text-2xl text-primary-600 tracking-tight">AppLogo</span>
                        </div>
                        <nav class="flex flex-1 flex-col">
                            <ul role="list" class="flex flex-1 flex-col gap-y-7">
                                <li>
                                    <ul role="list" class="-mx-2 space-y-1">
                                        <!-- Mobile Navigation Items -->
                                        <li>
                                            <a href="{{ route('dashboard') }}"
                                                class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('dashboard') ? 'bg-secondary-50 text-secondary-600' : 'text-secondary-700 hover:text-primary-600 hover:bg-secondary-50' }}">
                                                Dashboard
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('components.design') }}"
                                                class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('components.design') ? 'bg-secondary-50 text-secondary-600' : 'text-secondary-700 hover:text-primary-600 hover:bg-secondary-50' }}">
                                                Design System
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('features.vault') }}"
                                                class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('features.vault') ? 'bg-secondary-50 text-secondary-600' : 'text-secondary-700 hover:text-primary-600 hover:bg-secondary-50' }}">
                                                The Vault
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('features.space') }}"
                                                class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('features.space') ? 'bg-secondary-50 text-secondary-600' : 'text-secondary-700 hover:text-primary-600 hover:bg-secondary-50' }}">
                                                The Space
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('features.garden') }}"
                                                class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('features.garden') ? 'bg-secondary-50 text-secondary-600' : 'text-secondary-700 hover:text-primary-600 hover:bg-secondary-50' }}">
                                                The Garden
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('features.rituals') }}"
                                                class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('features.rituals') ? 'bg-secondary-50 text-secondary-600' : 'text-secondary-700 hover:text-primary-600 hover:bg-secondary-50' }}">
                                                Daily Rituals
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('features.cupid') }}"
                                                class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('features.cupid') ? 'bg-secondary-50 text-secondary-600' : 'text-secondary-700 hover:text-primary-600 hover:bg-secondary-50' }}">
                                                AI Cupid
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>

                    <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                        <button type="button" @click="sidebarOpen = false" class="-m-2.5 p-2.5">
                            <span class="sr-only">Close sidebar</span>
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Static sidebar for desktop -->
        <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
            <div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-secondary-200 bg-white px-6 pb-4">
                <div class="flex h-16 shrink-0 items-center">
                    <span class="font-display font-bold text-2xl text-primary-600 tracking-tight">AppLogo</span>
                </div>
                <nav class="flex flex-1 flex-col">
                    <ul role="list" class="flex flex-1 flex-col gap-y-7">
                        <li>
                            <ul role="list" class="-mx-2 space-y-1">
                                <li>
                                    <a href="{{ route('dashboard') }}"
                                        class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('dashboard') ? 'bg-secondary-50 text-secondary-600' : 'text-secondary-700 hover:text-primary-600 hover:bg-secondary-50' }}">
                                        Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('components.design') }}"
                                        class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('components.design') ? 'bg-secondary-50 text-secondary-600' : 'text-secondary-700 hover:text-primary-600 hover:bg-secondary-50' }}">
                                        Design System
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('features.vault') }}"
                                        class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('features.vault') ? 'bg-secondary-50 text-secondary-600' : 'text-secondary-700 hover:text-primary-600 hover:bg-secondary-50' }}">
                                        The Vault
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('features.space') }}"
                                        class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('features.space') ? 'bg-secondary-50 text-secondary-600' : 'text-secondary-700 hover:text-primary-600 hover:bg-secondary-50' }}">
                                        The Space
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('features.garden') }}"
                                        class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('features.garden') ? 'bg-secondary-50 text-secondary-600' : 'text-secondary-700 hover:text-primary-600 hover:bg-secondary-50' }}">
                                        The Garden
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('features.rituals') }}"
                                        class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('features.rituals') ? 'bg-secondary-50 text-secondary-600' : 'text-secondary-700 hover:text-primary-600 hover:bg-secondary-50' }}">
                                        Daily Rituals
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('features.cupid') }}"
                                        class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('features.cupid') ? 'bg-secondary-50 text-secondary-600' : 'text-secondary-700 hover:text-primary-600 hover:bg-secondary-50' }}">
                                        AI Cupid
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="lg:pl-72">
            <div
                class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-secondary-200 bg-white/80 backdrop-blur-md px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
                <button type="button" @click="sidebarOpen = true" class="-m-2.5 p-2.5 text-secondary-700 lg:hidden">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>

                <!-- Separator -->
                <div class="h-6 w-px bg-secondary-200 lg:hidden" aria-hidden="true"></div>

                <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
                    <div class="flex flex-1 items-center gap-x-4 lg:gap-x-6 justify-end">
                        <!-- Profile dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" type="button" class="-m-1.5 flex items-center p-1.5"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <img class="h-8 w-8 rounded-full bg-secondary-50"
                                    src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'Guest' }}&background=0ea5e9&color=fff"
                                    alt="">
                                <span class="hidden lg:flex lg:items-center">
                                    <span class="ml-4 text-sm font-semibold leading-6 text-secondary-900"
                                        aria-hidden="true">{{ auth()->user()->name ?? 'Guest User' }}</span>
                                    <svg class="ml-2 h-5 w-5 text-secondary-400" viewBox="0 0 20 20" fill="currentColor"
                                        aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </button>

                            <div x-show="open" @click.away="open = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 z-10 mt-2.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-secondary-900/5 focus:outline-none"
                                role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                tabindex="-1">
                                <a href="#" class="block px-3 py-1 text-sm leading-6 text-secondary-900" role="menuitem"
                                    tabindex="-1" id="user-menu-item-1">Sign out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <main class="py-10">
                <div class="px-4 sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    <livewire:chat-widget />
    <x-ui.toast />
    @livewireScripts
</body>

</html>