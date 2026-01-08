<x-app-layout>
    @php
        $gamification = app(\App\Services\Features\GamificationService::class);
        $insights = app(\App\Services\Features\InsightsService::class);
        $health = $gamification->getGardenHealth(auth()->id());
        $userInsights = $insights->generateInsights(auth()->id());
    @endphp

    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-secondary-900 font-display">Our Garden</h1>
                <p class="text-secondary-600">Level {{ $health['level'] }}: {{ $health['level_name'] }}</p>
            </div>
            <div class="text-right">
                <div class="text-2xl font-bold text-purple-600">{{ $health['total_xp'] }} XP</div>
                <div class="text-sm text-secondary-500">{{ $userInsights['xp_this_month'] }} this month</div>
            </div>
        </div>

        <!-- Garden Visualization -->
        <x-ui.card>
            <div
                class="garden-container bg-gradient-to-b from-sky-100 to-green-50 rounded-lg p-10 min-h-[300px] relative">
                @if($health['state'] === 'blooming')
                    <div class="flex justify-center items-end gap-4">
                        <div class="text-6xl animate-pulse">✨</div>
                        <div class="text-8xl">💖</div>
                        <div class="text-6xl animate-pulse">✨</div>
                    </div>
                    <p class="text-center mt-6 text-lg font-semibold text-green-700">Your garden is blooming!</p>
                @elseif($health['state'] === 'healthy')
                    <div class="flex justify-center items-end gap-4">
                        <div class="text-7xl">💚</div>
                    </div>
                    <p class="text-center mt-6 text-lg font-semibold text-green-600">Growing strong together</p>
                @else
                    <div class="flex justify-center items-end gap-4">
                        <div class="text-6xl opacity-50">🤍</div>
                    </div>
                    <p class="text-center mt-6 text-secondary-600">Plant some seeds to grow your garden</p>
                @endif

                <!-- XP Progress Bar -->
                <div class="absolute bottom-4 left-4 right-4">
                    <div class="bg-white/80 backdrop-blur rounded-full h-4 overflow-hidden">
                        @php
                            $progress = $health['next_level_xp'] ? min(100, ($health['total_xp'] / $health['next_level_xp']) * 100) : 100;
                        @endphp
                        <div class="bg-gradient-to-r from-green-400 to-emerald-500 h-full transition-all"
                            style="width: {{ $progress }}%">
                        </div>
                    </div>
                    <p class="text-xs text-secondary-600 mt-1 text-center">
                        {{ $health['total_xp'] }} / {{ $health['next_level_xp'] ?? 'MAX' }} XP to next level
                    </p>
                </div>
            </div>
        </x-ui.card>

        <!-- Daily Check-In -->
        <div>
            @livewire('features.daily-check-in')
        </div>

        <!-- Insights Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <x-ui.card title="Conflicts Resolved">
                <div class="text-4xl font-bold text-green-600 mb-2">{{ $userInsights['conflicts_resolved'] }}</div>
                <p class="text-sm text-secondary-600">This month</p>
            </x-ui.card>

            <x-ui.card title="Vault Memories">
                <div class="text-4xl font-bold text-purple-600 mb-2">{{ $userInsights['vault_items_count'] }}</div>
                <p class="text-sm text-secondary-600">Stored forever</p>
            </x-ui.card>

            <x-ui.card title="Mood Trend">
                @if($userInsights['mood_trend'] === 'positive')
                    <div class="text-4xl mb-2">😊</div>
                    <p class="text-sm text-green-600 font-medium">Trending positive!</p>
                @elseif($userInsights['mood_trend'] === 'negative')
                    <div class="text-4xl mb-2">😢</div>
                    <p class="text-sm text-blue-600 font-medium">Need support?</p>
                @else
                    <div class="text-4xl mb-2">😐</div>
                    <p class="text-sm text-secondary-600 font-medium">Steady as she goes</p>
                @endif
            </x-ui.card>
        </div>

        <!-- AI Suggestions -->
        @if(count($userInsights['suggestions']) > 0)
            <x-ui.card title="💡 Insights & Suggestions">
                <ul class="space-y-3">
                    @foreach($userInsights['suggestions'] as $suggestion)
                        <li class="flex items-start gap-3">
                            <span class="text-purple-500 mt-1">•</span>
                            <span class="text-secondary-700">{{ $suggestion }}</span>
                        </li>
                    @endforeach
                </ul>
            </x-ui.card>
        @endif

        <!-- Quick Actions -->
        <x-ui.card title="Quick Actions">
            <div class="grid grid-cols-3 gap-4">
                <a href="{{ route('vault') }}"
                    class="text-center p-4 rounded-lg border-2 border-secondary-200 hover:border-purple-400 hover:bg-purple-50 transition">
                    <div class="text-3xl mb-2">🔒</div>
                    <div class="text-sm font-medium text-secondary-700">The Vault</div>
                </a>
                <a href="{{ route('space') }}"
                    class="text-center p-4 rounded-lg border-2 border-secondary-200 hover:border-blue-400 hover:bg-blue-50 transition">
                    <div class="text-3xl mb-2">🌙</div>
                    <div class="text-sm font-medium text-secondary-700">Need Space</div>
                </a>
                <a href="{{ route('features.conflict-chat') }}"
                    class="text-center p-4 rounded-lg border-2 border-secondary-200 hover:border-pink-400 hover:bg-pink-50 transition">
                    <div class="text-3xl mb-2">💬</div>
                    <div class="text-sm font-medium text-secondary-700">Resolve</div>
                </a>
            </div>
        </x-ui.card>
    </div>
</x-app-layout>