<x-app-layout>
    @php
        $gamification = app(\App\Services\Features\GamificationService::class);
        $insights = app(\App\Services\Features\InsightsService::class);
        
        $userId = auth()->id();
        $garden = $gamification->getGardenHealth($userId);
        $data = $insights->generateInsights($userId);
    @endphp

    <!-- Welcome Header -->
    <div class="mb-8">
        <h1 class="text-4xl lg:text-5xl font-display font-bold text-white mb-2">
            Welcome back, {{ auth()->user()->name }} 👋
        </h1>
        <p class="text-white/60 text-lg">Your relationship journey continues...</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <!-- Level Card -->
        <div class="bg-gradient-to-br from-primary-500/20 to-pink-500/20 backdrop-blur-xl rounded-3xl p-6 border border-white/10">
            <div class="flex items-center justify-between mb-3">
                <span class="text-white/60 text-sm font-medium">Level</span>
                <div class="w-10 h-10 rounded-full bg-primary-500 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-white">{{ $garden['level'] }}</p>
            <p class="text-white/40 text-xs mt-1">{{ $garden['level_name'] }}</p>
        </div>

        <!-- XP Card -->
        <div class="bg-gradient-to-br from-purple-500/20 to-blue-500/20 backdrop-blur-xl rounded-3xl p-6 border border-white/10">
            <div class="flex items-center justify-between mb-3">
                <span class="text-white/60 text-sm font-medium">Total XP</span>
                <div class="w-10 h-10 rounded-full bg-purple-500 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-white">{{ number_format($garden['total_xp']) }}</p>
            <p class="text-white/40 text-xs mt-1">+{{ $data['xp_this_month'] }} this month</p>
        </div>

        <!-- Vault Items -->
        <div class="bg-gradient-to-br from-amber-500/20 to-orange-500/20 backdrop-blur-xl rounded-3xl p-6 border border-white/10">
            <div class="flex items-center justify-between mb-3">
                <span class="text-white/60 text-sm font-medium">Memories</span>
                <div class="w-10 h-10 rounded-full bg-amber-500 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-white">{{ $data['vault_items_count'] }}</p>
            <p class="text-white/40 text-xs mt-1">in The Vault</p>
        </div>

        <!-- Mood Trend -->
        <div class="bg-gradient-to-br from-green-500/20 to-emerald-500/20 backdrop-blur-xl rounded-3xl p-6 border border-white/10">
            <div class="flex items-center justify-between mb-3">
                <span class="text-white/60 text-sm font-medium">Mood</span>
                <div class="w-10 h-10 rounded-full bg-green-500 flex items-center justify-center">
                    @if($data['mood_trend'] === 'positive')
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    @else
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    @endif
                </div>
            </div>
            <p class="text-3xl font-bold text-white capitalize">{{ $data['mood_trend'] }}</p>
            <p class="text-white/40 text-xs mt-1">7-day trend</p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid lg:grid-cols-2 gap-6 mb-8">
        <!-- Relationship Health -->
        <div class="bg-white/5 backdrop-blur-xl rounded-3xl p-8 border border-white/10 hover:border-primary-500/50 transition-all group">
            <div class="flex items-start justify-between mb-6">
                <div>
                    <h3 class="text-2xl font-bold text-white mb-2">Relationship Health</h3>
                    <p class="text-white/60">Your garden is {{ $data['relationship_health'] }}</p>
                </div>
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-primary-500 to-pink-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
            </div>
            
            <!-- Progress Bar -->
            <div class="mb-4">
                <div class="flex justify-between text-sm text-white/60 mb-2">
                    <span>Progress to Next Level</span>
                    <span>{{ $garden['next_level_xp'] ? round(($garden['total_xp'] / $garden['next_level_xp']) * 100) : 100 }}%</span>
                </div>
                <div class="h-3 bg-white/10 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-primary-500 to-pink-500 rounded-full transition-all duration-500" 
                         style="width: {{ $garden['next_level_xp'] ? min(100, ($garden['total_xp'] / $garden['next_level_xp']) * 100) : 100 }}%">
                    </div>
                </div>
            </div>

            <a href="{{ route('features.garden') }}" class="inline-flex items-center gap-2 text-primary-400 hover:text-primary-300 font-medium transition-colors">
                <span>Visit The Garden</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>

        <!-- Activity Summary -->
        <div class="bg-white/5 backdrop-blur-xl rounded-3xl p-8 border border-white/10">
            <h3 class="text-2xl font-bold text-white mb-6">This Month</h3>
            
            <div class="space-y-4">
                @if($data['conflicts_resolved'] > 0)
                    <div class="flex items-center gap-4 p-4 bg-white/5 rounded-2xl">
                        <div class="w-12 h-12 rounded-xl bg-green-500/20 flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-white font-medium">{{ $data['conflicts_resolved'] }} Conflicts Resolved</p>
                            <p class="text-white/40 text-sm">Great communication!</p>
                        </div>
                    </div>
                @endif

                @if($data['ghost_mode_count'] > 0)
                    <div class="flex items-center gap-4 p-4 bg-white/5 rounded-2xl">
                        <div class="w-12 h-12 rounded-xl bg-blue-500/20 flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-white font-medium">{{ $data['ghost_mode_count'] }} Ghost Mode Sessions</p>
                            <p class="text-white/40 text-sm">Healthy boundaries</p>
                        </div>
                    </div>
                @endif

                @if(empty($data['conflicts_resolved']) && empty($data['ghost_mode_count']))
                    <div class="text-center py-8 text-white/40">
                        <p>No activity yet this month</p>
                        <p class="text-sm mt-2">Start your journey today!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Suggestions -->
    @if(count($data['suggestions']) > 0)
        <div class="bg-gradient-to-br from-primary-500/10 to-pink-500/10 backdrop-blur-xl rounded-3xl p-8 border border-primary-500/20">
            <h3 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                <svg class="w-7 h-7 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                </svg>
                Suggestions for You
            </h3>
            
            <div class="space-y-3">
                @foreach($data['suggestions'] as $suggestion)
                    <div class="flex items-start gap-4 p-4 bg-white/5 rounded-2xl hover:bg-white/10 transition-colors">
                        <div class="w-2 h-2 rounded-full bg-primary-500 mt-2"></div>
                        <p class="text-white/90 flex-1">{{ $suggestion }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</x-app-layout>