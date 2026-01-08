<div class="min-h-full flex flex-col items-center justify-center p-6 bg-secondary-50 dark:bg-black transition-colors duration-700">
    
    <div class="text-center max-w-2xl w-full space-y-12">
        
        <!-- Header -->
        <div class="space-y-4">
            <h1 class="text-3xl font-bold text-secondary-900 dark:text-white font-display">Daily Ritual</h1>
            <p class="text-secondary-500 dark:text-secondary-400">
                Tune into your heart. Align your energy.
            </p>
        </div>

        @if(!$currentMood)
            <!-- Selection State -->
            <div class="animate-fade-in-up">
                <h2 class="text-2xl font-medium text-secondary-900 dark:text-white mb-8">How is your heart today?</h2>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 justify-items-center">
                    @foreach($moods as $key => $mood)
                        <button wire:click="selectMood('{{ $key }}')" 
                                class="group flex flex-col items-center gap-4 transition-transform hover:scale-105">
                            <div class="w-24 h-24 rounded-full {{ $mood['color'] }} shadow-lg ring-4 ring-transparent group-hover:ring-white/20 transition-all cursor-pointer"></div>
                            <span class="text-sm font-medium text-secondary-600 dark:text-secondary-300 group-hover:text-white">{{ $mood['label'] }}</span>
                        </button>
                    @endforeach
                </div>
            </div>
        @else
            <!-- Result State -->
            <div class="relative bg-white dark:bg-white/5 border border-secondary-200 dark:border-white/10 rounded-3xl p-8 md:p-12 shadow-xl overflow-hidden">
                
                <!-- My Aura (Background Glow) -->
                <div class="absolute top-0 left-0 w-full h-full opacity-20 dark:opacity-30 blur-3xl pointer-events-none {{ $moods[$currentMood]['color'] }}"></div>

                <div class="relative z-10 flex flex-col gap-12">
                    
                    <!-- My Status -->
                    <div class="text-center">
                        <div class="inline-block w-4 h-4 rounded-full {{ $moods[$currentMood]['color'] }} mb-2"></div>
                        <h3 class="text-xl font-bold text-secondary-900 dark:text-white">Your Heart is {{ explode(' / ', $moods[$currentMood]['label'])[0] }}</h3>
                        <p class="text-secondary-500 dark:text-secondary-400 mt-2 italic">"{{ $moods[$currentMood]['desc'] }}"</p>
                    </div>

                    <div class="w-full h-px bg-secondary-200 dark:bg-white/10"></div>

                    <!-- Partner Status & Alignment -->
                    @if($partner)
                        @if($partnerMood)
                            <div class="text-center">
                                <div class="flex items-center justify-center gap-8 mb-6">
                                    <div class="flex flex-col items-center gap-2">
                                        <div class="w-16 h-16 rounded-full {{ $moods[$currentMood]['color'] }} shadow-lg ring-2 ring-white/10"></div>
                                        <span class="text-xs text-secondary-500">You</span>
                                    </div>
                                    
                                    <!-- Connection Line -->
                                    <div class="h-1 w-16 bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>

                                    <div class="flex flex-col items-center gap-2">
                                        <div class="w-16 h-16 rounded-full {{ $moods[$partnerMood]['color'] }} shadow-lg ring-2 ring-white/10"></div>
                                        <span class="text-xs text-secondary-500">{{ $partner->name }}</span>
                                    </div>
                                </div>

                                <div class="bg-secondary-50 dark:bg-black/20 rounded-xl p-6">
                                    <h4 class="text-lg font-bold {{ $this->alignment['color'] }} mb-2">
                                        {{ $this->alignment['title'] }}
                                    </h4>
                                    <p class="text-secondary-600 dark:text-secondary-300">
                                        {{ $this->alignment['desc'] }}
                                    </p>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-6">
                                <div class="w-16 h-16 rounded-full bg-secondary-200 dark:bg-white/5 mx-auto mb-4 flex items-center justify-center text-2xl animate-pulse">
                                    ?
                                </div>
                                <h3 class="font-medium text-secondary-900 dark:text-white">Waiting for {{ $partner->name }}...</h3>
                                <p class="text-sm text-secondary-500 dark:text-secondary-400 mt-1">Their aura will appear here once they check in.</p>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-6">
                             <h3 class="font-medium text-secondary-900 dark:text-white">No Partner Linked</h3>
                             <p class="text-sm text-secondary-500 dark:text-secondary-400 mt-1">Link with a partner in The Garden to see Aura Alignment.</p>
                             <a href="{{ route('features.garden') }}" class="inline-block mt-4 text-primary-500 hover:text-primary-400 text-sm font-medium">Go to Garden &rarr;</a>
                        </div>
                    @endif

                </div>
            </div>
        @endif
    </div>
</div>
