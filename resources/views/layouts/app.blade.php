<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Project US') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|outfit:600,700,800" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gradient-to-br from-secondary-950 via-secondary-900 to-secondary-800 min-h-screen">
    
    <!-- Mobile Bottom Nav -->
    <div class="lg:hidden fixed bottom-0 left-0 right-0 z-50 bg-secondary-900/95 backdrop-blur-xl border-t border-white/10 safe-area-pb">
        <div class="flex items-center justify-around h-20 px-4">
            <a href="{{ route('dashboard') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('dashboard') ? 'text-primary-500' : 'text-white/60' }} transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span class="text-xs font-medium">Home</span>
            </a>
            <a href="{{ route('features.vault') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('features.vault') ? 'text-primary-500' : 'text-white/60' }} transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span class="text-xs font-medium">Vault</span>
            </a>
            <a href="{{ route('features.garden') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('features.garden') ? 'text-primary-500' : 'text-white/60' }} transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
                <span class="text-xs font-medium">Garden</span>
            </a>
            <a href="{{ route('features.rituals') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('features.rituals') ? 'text-primary-500' : 'text-white/60' }} transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-xs font-medium">Mood</span>
            </a>
            <a href="{{ route('features.cupid') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('features.cupid') ? 'text-primary-500' : 'text-white/60' }} transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                </svg>
                <span class="text-xs font-medium">Cupid</span>
            </a>
        </div>
    </div>

    <!-- Desktop Sidebar -->
    <div class="hidden lg:flex fixed left-0 top-0 bottom-0 w-72 bg-secondary-900/50 backdrop-blur-xl border-r border-white/10 flex-col z-40">
        <!-- Logo -->
        <div class="p-8 border-b border-white/10">
            <h1 class="text-3xl font-display font-bold bg-gradient-to-r from-primary-500 to-pink-500 bg-clip-text text-transparent">
                Project US
            </h1>
            <p class="text-white/40 text-sm mt-1">Relationship Reimagined</p>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 p-6 space-y-2">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-4 px-4 py-3 rounded-2xl transition-all {{ request()->routeIs('dashboard') ? 'bg-primary-500 text-white shadow-lg shadow-primary-500/30' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span class="font-medium">Dashboard</span>
            </a>
            
            <a href="{{ route('features.vault') }}" class="flex items-center gap-4 px-4 py-3 rounded-2xl transition-all {{ request()->routeIs('features.vault') ? 'bg-primary-500 text-white shadow-lg shadow-primary-500/30' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span class="font-medium">The Vault</span>
            </a>

            <a href="{{ route('features.space') }}" class="flex items-center gap-4 px-4 py-3 rounded-2xl transition-all {{ request()->routeIs('features.space') ? 'bg-primary-500 text-white shadow-lg shadow-primary-500/30' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                </svg>
                <span class="font-medium">The Space</span>
            </a>

            <a href="{{ route('features.garden') }}" class="flex items-center gap-4 px-4 py-3 rounded-2xl transition-all {{ request()->routeIs('features.garden') ? 'bg-primary-500 text-white shadow-lg shadow-primary-500/30' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
                <span class="font-medium">The Garden</span>
            </a>

            <a href="{{ route('features.rituals') }}" class="flex items-center gap-4 px-4 py-3 rounded-2xl transition-all {{ request()->routeIs('features.rituals') ? 'bg-primary-500 text-white shadow-lg shadow-primary-500/30' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium">Daily Rituals</span>
            </a>

            <a href="{{ route('features.cupid') }}" class="flex items-center gap-4 px-4 py-3 rounded-2xl transition-all {{ request()->routeIs('features.cupid') ? 'bg-primary-500 text-white shadow-lg shadow-primary-500/30' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                </svg>
                <span class="font-medium">AI Cupid</span>
            </a>
        </nav>

        <!-- User Profile -->
        <div class="p-6 border-t border-white/10">
            <div class="flex items-center gap-3 p-3 rounded-2xl bg-white/5 hover:bg-white/10 transition-colors cursor-pointer">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary-500 to-pink-500 flex items-center justify-center text-white font-bold">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-white font-medium truncate">{{ auth()->user()->name }}</p>
                    <p class="text-white/40 text-xs truncate">{{ auth()->user()->email }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-white/40 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="lg:ml-72 min-h-screen pb-24 lg:pb-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {{ $slot }}
        </div>
    </div>

    @livewireScripts
</body>
</html>