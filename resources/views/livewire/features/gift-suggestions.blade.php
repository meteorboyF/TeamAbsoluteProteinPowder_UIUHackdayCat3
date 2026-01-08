<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-display font-bold bg-gradient-to-r from-primary-400 to-pink-400 bg-clip-text text-transparent mb-4">
                AI Gift Whisperer
            </h1>
            <p class="text-white/60 text-lg">Curated just for your partner's unique personality.</p>
        </div>

        <!-- Input Zone -->
        <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-8 mb-12 shadow-2xl">
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-white mb-2 font-bold">Partner's Vibe</label>
                    <input type="text" wire:model="partnerType" placeholder="e.g., Creative Soul, Tech Geek, Adventurer..." class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-white mb-2 font-bold">Hobbies & Interests</label>
                    <input type="text" wire:model="hobbies" placeholder="e.g., Jazz, Pottery, Hiking..." class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-primary-500">
                </div>
            </div>
            <div class="mt-6 text-center">
                <button wire:click="generateIdeas" class="px-8 py-3 bg-gradient-to-r from-primary-500 to-pink-500 hover:from-primary-600 hover:to-pink-600 text-white font-bold rounded-full shadow-lg shadow-primary-500/30 transition-all transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed">
                    <span wire:loading.remove>🔮 Reveal Perfect Gifts</span>
                    <span wire:loading>✨ AI is Thinking...</span>
                </button>
            </div>
        </div>

        <!-- AI Output Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @if(empty($suggestions) && !$isLoading)
                <!-- Empty State -->
                <div class="col-span-full text-center text-white/40 py-12">
                    <p class="text-xl">Tell us about your partner to unlock ideas.</p>
                </div>
            @endif

            @foreach($suggestions as $item)
            <div class="group relative bg-white/5 backdrop-blur-lg border border-white/10 rounded-2xl overflow-hidden hover:bg-white/10 transition-all duration-300 hover:scale-[1.02] animate-fade-in-up">
                <div class="h-48 bg-gradient-to-br from-primary-500/20 to-purple-500/20 flex items-center justify-center">
                    <span class="text-6xl">🎁</span>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-white mb-2">{{ $item['title'] ?? 'Gift Idea' }}</h3>
                    <p class="text-white/60 text-sm mb-4">{{ $item['description'] ?? '' }}</p>
                    <div class="flex justify-between items-center mt-4">
                        <span class="px-3 py-1 rounded-full bg-primary-500/20 text-primary-300 text-xs font-bold uppercase tracking-wide">
                            {{ $item['match_score'] ?? '90%' }} Match
                        </span>
                        <button class="text-white hover:text-primary-400 font-medium transition-colors">Find Online →</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
