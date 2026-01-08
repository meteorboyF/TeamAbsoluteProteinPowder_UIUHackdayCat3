<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="max-w-6xl w-full">
            <!-- Hero Section -->
            <div class="text-center mb-16">
                <h1 class="text-6xl lg:text-8xl font-display font-bold bg-gradient-to-r from-primary-500 via-pink-500 to-purple-500 bg-clip-text text-transparent mb-6 animate-pulse">
                    US
                </h1>
                <p class="text-2xl lg:text-3xl text-white/80 mb-4 font-light">
                    Relationship Reimagined
                </p>
                <p class="text-lg text-white/60 max-w-2xl mx-auto mb-12">
                    A modern platform designed for couples to grow together, communicate better, and build lasting memories.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-gradient-to-r from-primary-500 to-pink-500 hover:from-primary-600 hover:to-pink-600 text-white font-bold rounded-2xl shadow-lg shadow-primary-500/30 hover:shadow-primary-500/50 transition-all transform hover:scale-105 active:scale-95">
                        Get Started Free
                    </a>
                    <a href="{{ route('login') }}" class="px-8 py-4 bg-white/10 hover:bg-white/20 backdrop-blur-xl text-white font-medium rounded-2xl border border-white/20 transition-all">
                        Sign In
                    </a>
                </div>
            </div>

            <!-- Features Grid -->
            <div class="grid md:grid-cols-3 gap-6 mb-16">
                <!-- The Vault -->
                <div class="bg-white/5 backdrop-blur-xl rounded-3xl p-8 border border-white/10 hover:border-primary-500/50 transition-all group hover:scale-105 transform">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-amber-500 to-orange-500 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">The Vault</h3>
                    <p class="text-white/60">Lock away photos and voice notes to unlock on special dates or relationship milestones.</p>
                </div>

                <!-- The Garden -->
                <div class="bg-white/5 backdrop-blur-xl rounded-3xl p-8 border border-white/10 hover:border-primary-500/50 transition-all group hover:scale-105 transform">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-green-500 to-emerald-500 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">The Garden</h3>
                    <p class="text-white/60">Watch your relationship grow visually as you earn XP through positive actions and milestones.</p>
                </div>

                <!-- The Space -->
                <div class="bg-white/5 backdrop-blur-xl rounded-3xl p-8 border border-white/10 hover:border-primary-500/50 transition-all group hover:scale-105 transform">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-500 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">The Space</h3>
                    <p class="text-white/60">Ghost Mode lets you take healthy breaks while respecting each other's boundaries.</p>
                </div>
            </div>

            <!-- Secondary Features -->
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Daily Rituals -->
                <div class="bg-white/5 backdrop-blur-xl rounded-3xl p-8 border border-white/10 hover:border-primary-500/50 transition-all">
                    <div class="flex items-start gap-6">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center flex-shrink-0">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white mb-2">Daily Rituals</h3>
                            <p class="text-white/60">Check in daily with mood tracking and see how aligned you are with your partner.</p>
                        </div>
                    </div>
                </div>

                <!-- AI Cupid -->
                <div class="bg-white/5 backdrop-blur-xl rounded-3xl p-8 border border-white/10 hover:border-primary-500/50 transition-all">
                    <div class="flex items-start gap-6">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-primary-500 to-pink-500 flex items-center justify-center flex-shrink-0">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white mb-2">AI Cupid</h3>
                            <p class="text-white/60">Get personalized gift ideas and date night suggestions based on your relationship data.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center mt-16">
                <p class="text-white/40 text-sm">
                    Built with ❤️ for modern couples
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>