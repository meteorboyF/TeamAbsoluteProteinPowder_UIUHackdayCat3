<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>US - When Words Go Quiet</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full antialiased font-sans bg-secondary-950 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-secondary-800 via-secondary-950 to-secondary-950 text-white">

    <!-- Navigation -->
    <header class="absolute top-0 left-0 right-0 z-50">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="text-2xl font-bold text-white font-display">US</div>
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-white/80 hover:text-white transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-white/80 hover:text-white transition">Login</a>
                    <a href="{{ route('register') }}"
                        class="bg-white/10 backdrop-blur-sm text-white px-6 py-2 rounded-full hover:bg-white/20 transition border border-white/10">
                        Get Started
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <div class="min-h-screen flex items-center justify-center px-6 relative overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-primary-500/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-primary-600/5 rounded-full blur-3xl animate-pulse"
                style="animation-delay: 1s;"></div>
        </div>

        <div class="max-w-5xl mx-auto text-center relative z-10">
            <!-- Main Headline -->
            <div class="mb-8">
                <p class="text-primary-500 text-sm uppercase tracking-widest mb-4 font-medium">The Hackathon Riddle</p>
                <h1 class="text-6xl md:text-7xl font-bold text-white mb-6 leading-tight font-display">
                    When Words Go Quiet
                </h1>
                <p class="text-2xl md:text-3xl text-white/80 font-light italic mb-8">
                    "Every look, sound, shape can tell a story."
                </p>
            </div>

            <!-- Tagline -->
            <p class="text-xl text-white/70 max-w-2xl mx-auto mb-12">
                The relationship app for couples who speak without words.
                Built on the power of <span class="text-primary-400 font-semibold">Light</span>,
                <span class="text-red-400 font-semibold">Sound</span>, and
                <span class="text-pink-400 font-semibold">Heart</span>.
            </p>

            <!-- CTA Buttons -->
            <div class="flex items-center justify-center gap-4 mb-16">
                <a href="{{ route('register') }}"
                    class="bg-primary-600 text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-primary-500 transition shadow-lg shadow-primary-900/20">
                    Start Your Journey
                </a>
                <a href="#wonders"
                    class="bg-white/5 backdrop-blur-sm text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-white/10 transition border border-white/10">
                    Learn More
                </a>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-3 gap-8 max-w-3xl mx-auto">
                <div class="text-center">
                    <div class="text-4xl font-bold text-white mb-2">6</div>
                    <div class="text-white/60 text-sm">Relationship Levels</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-white mb-2">3</div>
                    <div class="text-white/60 text-sm">Core Features</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-white mb-2">∞</div>
                    <div class="text-white/60 text-sm">Ways to Connect</div>
                </div>
            </div>
        </div>
    </div>

    <!-- The Wonders Section -->
    <div id="wonders" class="min-h-screen bg-secondary-900 py-20 px-6 border-t border-white/5">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-white mb-4 font-display">The Three Wonders</h2>
                <p class="text-xl text-white/60">Our answer to the hackathon challenge</p>
            </div>

            <div class="grid md:grid-cols-3 gap-12">
                <!-- Wonder 1: The Space -->
                <div class="text-center group">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-secondary-800 to-secondary-900 border border-white/10 rounded-full mx-auto mb-6 flex items-center justify-center group-hover:border-primary-500/50 transition">
                        <svg class="w-10 h-10 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">The Space</h3>
                    <p class="text-white/40 mb-4 italic">"Between light and sound, a new language"</p>
                    <p class="text-white/70">
                        Signal you need alone time with a gentle light. No words, no guilt—just understanding.
                    </p>
                </div>

                <!-- Wonder 2: The Vault -->
                <div class="text-center group">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-secondary-800 to-secondary-900 border border-white/10 rounded-full mx-auto mb-6 flex items-center justify-center group-hover:border-primary-500/50 transition">
                        <svg class="w-10 h-10 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">The Vault</h3>
                    <p class="text-white/40 mb-4 italic">"Sharing a secret with no words"</p>
                    <p class="text-white/70">
                        Lock memories in time capsules. Rub to reveal hidden photos. Your private sanctuary.
                    </p>
                </div>

                <!-- Wonder 3: The Garden -->
                <div class="text-center group">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-secondary-800 to-secondary-900 border border-white/10 rounded-full mx-auto mb-6 flex items-center justify-center group-hover:border-primary-500/50 transition">
                        <svg class="w-10 h-10 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">The Garden</h3>
                    <p class="text-white/40 mb-4 italic">"From the heart, not the mouth"</p>
                    <p class="text-white/70">
                        Watch your relationship bloom. From strangers to soulmates, visualized as a living garden.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer CTA -->
    <div class="bg-secondary-950 py-16 px-6 text-center border-t border-white/5">
        <div class="relative">
             <div class="absolute inset-0 flex justify-center items-center opacity-20 pointer-events-none">
                <div class="w-64 h-64 bg-primary-600 rounded-full blur-3xl"></div>
            </div>
            <div class="relative z-10">
                <h2 class="text-3xl font-bold text-white mb-4">Ready to speak without words?</h2>
                <a href="{{ route('register') }}"
                    class="inline-block bg-primary-600 text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-primary-500 transition shadow-lg shadow-primary-900/20">
                    Create Your Garden
                </a>
            </div>
        </div>
    </div>

</body>

</html>