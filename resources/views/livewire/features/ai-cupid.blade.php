<div class="h-full flex flex-col gap-6" x-data="{ init() { @if($isAnalyzing) setTimeout(() => $wire.analyze(), 1000) @endif } }">
    
    <!-- Header -->
    <div class="flex items-center gap-4 mb-4">
        <div class="w-12 h-12 rounded-full bg-gradient-to-tr from-rose-400 to-orange-400 flex items-center justify-center text-white text-2xl shadow-md">
            💘
        </div>
        <div>
            <h1 class="text-3xl font-bold text-secondary-900 dark:text-white font-display">AI Cupid</h1>
            <p class="text-sm text-secondary-500 dark:text-secondary-400">Intelligent Heart-to-Heart Suggestions</p>
        </div>
    </div>

    @if($isAnalyzing)
        <!-- Loading State -->
        <div class="flex-1 flex flex-col items-center justify-center bg-white dark:bg-white/5 rounded-3xl border border-secondary-200 dark:border-white/10 shadow-sm min-h-[400px]">
            <div class="relative w-24 h-24 mb-6">
                <div class="absolute inset-0 rounded-full border-4 border-rose-200 dark:border-rose-900 border-t-rose-500 animate-spin"></div>
                <div class="absolute inset-4 rounded-full bg-rose-50 dark:bg-white/5 flex items-center justify-center text-2xl animate-pulse">
                    🤖
                </div>
            </div>
            <h2 class="text-xl font-bold text-secondary-900 dark:text-white animate-pulse">Analyzing Relationship Data...</h2>
            <div class="mt-4 space-y-2 text-sm text-secondary-500 dark:text-secondary-400 text-center">
                <p>Checking Partner Mood...</p>
                <p>Calculating Relationship Level...</p>
                <p>Scanning Romantic database...</p>
            </div>
        </div>
    @else
        <!-- Results Interface -->
        <div class="flex-1 flex flex-col lg:flex-row gap-6">
            
            <!-- Context Sidebar -->
            <div class="w-full lg:w-1/3 space-y-6">
                <x-ui.card class="bg-gradient-to-br from-rose-50 to-orange-50 dark:from-rose-900/20 dark:to-orange-900/20 border-rose-100 dark:border-rose-500/20">
                    <h3 class="font-bold text-rose-900 dark:text-rose-100 mb-4">Analysis Context</h3>
                    
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-white/50 flex items-center justify-center">❤️</div>
                            <div>
                                <p class="text-xs text-rose-600 dark:text-rose-300">Partner</p>
                                <p class="font-medium text-rose-900 dark:text-white">{{ $partner ? $partner->name : 'Unknown' }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-white/50 flex items-center justify-center">🎭</div>
                            <div>
                                <p class="text-xs text-rose-600 dark:text-rose-300">Current Mood</p>
                                <p class="font-medium text-rose-900 dark:text-white uppercase">{{ $partnerMood ? str_replace('mood_', '', $partnerMood) : 'Not Checked In' }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-white/50 flex items-center justify-center">📊</div>
                            <div>
                                <p class="text-xs text-rose-600 dark:text-rose-300">Relationship Level</p>
                                <p class="font-medium text-rose-900 dark:text-white">Level {{ $relationshipLevel }}</p>
                            </div>
                        </div>
                    </div>
                </x-ui.card>
            </div>

            <!-- Suggestions Area -->
            <div class="w-full lg:w-2/3">
                <!-- Tabs -->
                <div class="flex gap-4 mb-6 border-b border-secondary-200 dark:border-white/10 pb-1">
                    <button wire:click="$set('currentTab', 'gifts')" 
                            class="pb-3 px-4 font-medium transition-colors {{ $currentTab === 'gifts' ? 'text-rose-600 border-b-2 border-rose-600 cursor-default' : 'text-secondary-500 hover:text-rose-500' }}">
                        🎁 Gift Lab
                    </button>
                    <button wire:click="$set('currentTab', 'dates')" 
                            class="pb-3 px-4 font-medium transition-colors {{ $currentTab === 'dates' ? 'text-rose-600 border-b-2 border-rose-600 cursor-default' : 'text-secondary-500 hover:text-rose-500' }}">
                        📅 Date Planner
                    </button>
                </div>

                <!-- Gift Content -->
                @if($currentTab === 'gifts')
                    <div class="grid sm:grid-cols-2 gap-4 animate-fade-in-up">
                        @forelse($giftSuggestions as $gift)
                            <div class="bg-white dark:bg-white/5 p-6 rounded-2xl border border-secondary-200 dark:border-white/10 hover:border-rose-400 dark:hover:border-rose-500/50 transition-colors group">
                                <div class="text-4xl mb-4 group-hover:scale-110 transition-transform duration-300 inline-block">{{ $gift['icon'] }}</div>
                                <h4 class="font-bold text-secondary-900 dark:text-white mb-2">{{ $gift['title'] }}</h4>
                                <p class="text-sm text-secondary-500 dark:text-secondary-400">{{ $gift['desc'] }}</p>
                                <button class="mt-4 text-xs font-bold text-rose-500 hover:text-rose-600 uppercase tracking-wide">Find Online &rarr;</button>
                            </div>
                        @empty
                            <p class="col-span-2 text-center text-secondary-500">No suggestions available. Try asking partner to check in!</p>
                        @endforelse
                    </div>
                @endif

                <!-- Date Content -->
                @if($currentTab === 'dates')
                    <div class="grid sm:grid-cols-2 gap-4 animate-fade-in-up">
                        @forelse($dateSuggestions as $date)
                            <div class="bg-white dark:bg-white/5 p-6 rounded-2xl border border-secondary-200 dark:border-white/10 hover:border-orange-400 dark:hover:border-orange-500/50 transition-colors">
                                <div class="flex justify-between items-start mb-4">
                                    <h4 class="font-bold text-secondary-900 dark:text-white text-lg">{{ $date['title'] }}</h4>
                                    <span class="px-2 py-1 bg-secondary-100 dark:bg-white/10 text-xs rounded text-secondary-600 dark:text-secondary-300">{{ $date['time'] }}</span>
                                </div>
                                <p class="text-sm text-secondary-500 dark:text-secondary-400 mb-6">{{ $date['desc'] }}</p>
                                <x-ui.button class="w-full justify-center">
                                    Plan This Date
                                </x-ui.button>
                            </div>
                        @empty
                            <p class="col-span-2 text-center text-secondary-500">No date ideas found.</p>
                        @endforelse
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
