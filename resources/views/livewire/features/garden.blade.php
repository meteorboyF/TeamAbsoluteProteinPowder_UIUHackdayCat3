<div class="h-full flex flex-col gap-6">
    <!-- Header: Level & Status -->
    <div class="flex flex-col md:flex-row items-center justify-between bg-white dark:bg-white/5 p-6 rounded-3xl border border-secondary-200 dark:border-white/10 shadow-sm">
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-green-400 to-emerald-600 flex items-center justify-center text-2xl shadow-lg font-bold text-white">
                {{ $currentLevel }}
            </div>
            <div>
                <h2 class="text-2xl font-bold text-secondary-900 dark:text-white font-display">{{ $this->levelTitle }}</h2>
                <div class="flex items-center gap-2 text-sm text-secondary-500 dark:text-secondary-400">
                    <span>{{ $currentXp }} XP</span>
                    <div class="w-32 h-2 bg-secondary-100 dark:bg-white/10 rounded-full overflow-hidden">
                        <div class="h-full bg-green-500 transition-all duration-500" style="width: {{ ($currentXp / $nextLevelXp) * 100 }}%"></div>
                    </div>
                    <span>{{ $nextLevelXp }} XP</span>
                </div>
            </div>
        </div>
        <div class="mt-4 md:mt-0">
            <x-ui.button wire:click="waterGarden" class="bg-blue-500 hover:bg-blue-600 border-blue-600 text-white">
                <svg class="w-4 h-4 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                💧 Water Garden (+50 XP)
            </x-ui.button>
        </div>
    </div>

    <!-- Main Visual: The Garden -->
    <div class="flex-1 bg-gradient-to-b from-sky-300 via-sky-100 to-emerald-100 dark:from-indigo-950 dark:via-purple-900 dark:to-emerald-950 rounded-3xl relative overflow-hidden flex items-end justify-center min-h-[400px]">
        
        <!-- Sun/Moon -->
        <div class="absolute top-10 right-10 w-20 h-20 rounded-full bg-yellow-300 dark:bg-slate-200 shadow-[0_0_40px_rgba(253,224,71,0.6)] dark:shadow-[0_0_40px_rgba(255,255,255,0.2)] animate-pulse"></div>

        <!-- Garden Elements based on Level -->
        <div class="relative z-10 w-full max-w-4xl px-10 flex items-end justify-around pb-10">
            @if($currentLevel >= 1)
                <!-- Level 1: Saplings -->
                <div class="text-emerald-500 dark:text-emerald-400 animate-bounce" style="animation-duration: 3s">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                </div>
            @endif
            
            @if($currentLevel >= 3)
                <!-- Level 3: Small Flowers -->
                <div class="text-pink-500 dark:text-pink-400 animate-bounce" style="animation-duration: 2.5s">
                    <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
                </div>
            @endif

            @if($currentLevel >= 5)
                <!-- Level 5: Big Tree -->
                <div class="text-green-600 dark:text-green-500 transform scale-150">
                     <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C7.03 2 3 6.03 3 11c0 2.48 1.94 4.09 3.5 5.5.94.85 1.5 1.76 1.5 2.5V22h8v-3c0-.74.56-1.65 1.5-2.5C19.06 15.09 21 13.48 21 11c0-4.97-4.03-9-9-9z"/></svg>
                </div>
            @endif

             @if($currentLevel >= 2)
                <!-- Level 2: Bushes -->
                 <div class="text-emerald-600 dark:text-emerald-500 animate-pulse">
                    <svg class="w-14 h-14" fill="currentColor" viewBox="0 0 20 20"><path d="M13 7H7v6h6V7z"/></svg>
                </div>
            @endif

             @if($currentLevel >= 6)
                <!-- Level 6: Radiant Aura (Soulmates) -->
                <div class="absolute inset-0 bg-gradient-to-t from-pink-500/20 to-transparent animate-pulse pointer-events-none"></div>
            @endif
        </div>
        
        <!-- Ground -->
        <div class="absolute bottom-0 left-0 right-0 h-20 bg-emerald-800/20 backdrop-blur-sm border-t border-emerald-500/30"></div>
    </div>

    <!-- Partner Linking Section -->
    <div class="grid md:grid-cols-2 gap-6">
        <!-- My Code -->
        <x-ui.card>
            <div class="text-center">
                <h3 class="font-bold text-secondary-900 dark:text-white mb-2">Invite Partner</h3>
                <p class="text-sm text-secondary-500 mb-4">Share this code with your partner to link accounts.</p>
                <div class="bg-secondary-100 dark:bg-white/10 p-4 rounded-xl font-mono text-2xl font-bold tracking-widest text-secondary-900 dark:text-white select-all cursor-pointer">
                    {{ $partnerCode }}
                </div>
            </div>
        </x-ui.card>

        <!-- Link Partner -->
        <x-ui.card>
            @if($partner)
                <div class="text-center h-full flex flex-col items-center justify-center">
                    <div class="w-16 h-16 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center text-2xl font-bold mb-3">
                        {{ substr($partner->name, 0, 1) }}
                    </div>
                    <h3 class="font-bold text-secondary-900 dark:text-white">Linked with {{ $partner->name }}</h3>
                    <p class="text-sm text-green-600 dark:text-green-400 font-medium mt-1">❤️ Relationship Active</p>
                </div>
            @else
                <div class="text-center">
                    <h3 class="font-bold text-secondary-900 dark:text-white mb-2">Enter Partner Code</h3>
                    <p class="text-sm text-secondary-500 mb-4">Enter the code from your partner's screen.</p>
                    
                    <form wire:submit.prevent="linkPartner" class="flex flex-col gap-3">
                        <x-ui.input 
                            name="inputCode" 
                            wire:model="inputCode" 
                            placeholder="Ex: AB12CD" 
                            class="text-center uppercase font-mono tracking-widest"
                        />
                        <x-ui.button type="submit" class="justify-center">
                            Link Accounts
                        </x-ui.button>
                    </form>
                </div>
            @endif
        </x-ui.card>
    </div>
</div>
