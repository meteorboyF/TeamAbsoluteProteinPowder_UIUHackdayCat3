<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full antialiased font-sans text-white">

    <!-- Hero Section with Background Image -->
    <div class="relative min-h-screen flex flex-col">
        <!-- Background Image & Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1505664194779-8beaceb93744?q=80&w=2070&auto=format&fit=crop" 
                 alt="Library Background" 
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/70 mix-blend-multiply"></div>
        </div>

        <!-- Navigation (Transparent) -->
        <header class="relative z-10 w-full border-b border-white/10">
            <div class="max-w-7xl mx-auto px-6 h-24 flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <div class="flex flex-col">
                        <span class="text-2xl font-bold font-[Cinzel] tracking-wider text-white">ATTORNA</span>
                        <span class="text-[10px] tracking-[0.2em] text-[#bfa15f] uppercase">Attorneys at Law</span>
                    </div>
                </div>

                <!-- Nav Links -->
                <nav class="hidden md:flex items-center gap-8 text-sm font-medium tracking-wide">
                    <a href="#" class="text-white hover:text-[#bfa15f] transition-colors">Home</a>
                    <a href="#" class="text-gray-300 hover:text-[#bfa15f] transition-colors">Pages</a>
                    <a href="#" class="text-gray-300 hover:text-[#bfa15f] transition-colors">Practice Areas</a>
                    <a href="#" class="text-gray-300 hover:text-[#bfa15f] transition-colors">Attorney</a>
                    <a href="#" class="text-gray-300 hover:text-[#bfa15f] transition-colors">Blog</a>
                    
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-[#bfa15f] hover:text-[#d4b775] transition-colors">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-white hover:text-[#bfa15f] transition-colors">Login</a>
                    @endauth
                </nav>

                <!-- Icons / Search -->
                <div class="hidden md:flex items-center gap-4 text-white">
                    <button class="hover:text-[#bfa15f] transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg></button>
                </div>
            </div>
        </header>

        <!-- Hero Content -->
        <main class="relative z-10 flex-1 flex items-center justify-center text-center px-4">
            <div class="max-w-4xl mx-auto space-y-2">
                <!-- Subtitle -->
                <p class="text-[#bfa15f] text-lg md:text-xl tracking-[0.2em] uppercase font-medium mb-4">
                    Professional
                </p>

                <!-- Main Title -->
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold text-white tracking-tight font-display mb-6">
                    LAW FIRM
                </h1>

                <!-- Description -->
                <div class="max-w-2xl mx-auto mb-10">
                    <p class="text-gray-200 text-lg md:text-xl leading-relaxed font-light">
                        We are a leading law firm in financial & business industry.<br class="hidden md:block">
                        With more than 20 years of experience
                    </p>
                </div>

                <!-- CTA Button -->
                <div class="pt-8">
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-2 bg-[#bfa15f] hover:bg-[#a88d50] text-white px-8 py-4 text-sm font-bold tracking-widest uppercase transition-all duration-300 shadow-lg hover:shadow-[#bfa15f]/20">
                        Contact Now
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>
        </main>
    </div>

</body>
</html>
