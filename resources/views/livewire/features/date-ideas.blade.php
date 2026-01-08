<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="grid lg:grid-cols-2 gap-12">
            <!-- Left Panel: AI Recommendation & Inputs -->
            <div class="space-y-8">
                <div>
                    <h1 class="text-4xl font-display font-bold text-white mb-4">Date Night, Solved.</h1>
                    <p class="text-white/60 text-lg">AI-powered recommendations based on real-time location and mood.</p>
                </div>

                <!-- Input Card -->
                <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-8">
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-white/80 mb-2">Your Vibe Tonight</label>
                            <div class="flex flex-wrap gap-2">
                                @foreach(['Romantic', 'Adventurous', 'Chill', 'Luxury', 'Foodie'] as $v)
                                    <button wire:click="$set('vibe', '{{ $v }}')" class="px-4 py-2 rounded-full border border-white/10 {{ $vibe === $v ? 'bg-primary-500 border-primary-500' : 'bg-white/5' }} text-white hover:bg-primary-500 hover:border-primary-500 transition-all text-sm">
                                        {{ $v }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-white/80 mb-2">Location</label>
                            <div class="relative">
                                <input type="text" wire:model.blur="location" class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white pl-10 focus:outline-none focus:ring-2 focus:ring-primary-500">
                                <span class="absolute left-3 top-3.5 text-white/50">📍</span>
                            </div>
                        </div>

                        <button wire:click="generateDate" class="w-full py-4 bg-gradient-to-r from-primary-500 to-pink-500 rounded-xl text-white font-bold shadow-lg shadow-primary-500/30 transition-all transform hover:scale-[1.02] disabled:opacity-50">
                            <span wire:loading.remove>✨ Generate Perfect Date</span>
                            <span wire:loading>🗺️ Scouting Locations...</span>
                        </button>
                    </div>
                </div>

                <!-- AI Output -->
                @if($suggestion)
                <div class="bg-gradient-to-br from-indigo-900/40 to-purple-900/40 border border-white/10 rounded-3xl p-8 animate-fade-in">
                    <div class="flex items-start gap-4">
                        <div class="p-3 bg-white/10 rounded-xl">🤖</div>
                        <div>
                            <h3 class="text-xl font-bold text-white mb-2">AI Suggestion</h3>
                            <p class="text-white/80 leading-relaxed">
                                "{{ $suggestion }}"
                            </p>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Panel: Google Maps Style List -->
            <div class="bg-white/5 backdrop-blur-md rounded-3xl border border-white/10 overflow-hidden h-[800px] flex flex-col">
                <!-- Map Placeholder -->
                <div class="h-2/5 bg-gray-800 relative w-full overflow-hidden group">
                     <!-- Using a static map image based on location if possible, or generic -->
                    <div class="absolute inset-0 bg-cover bg-center opacity-50 group-hover:opacity-70 transition-opacity" style="background-image: url('https://maps.googleapis.com/maps/api/staticmap?center={{ urlencode($location) }}&zoom=13&size=600x300&maptype=roadmap&sensor=false&key={{ env('GOOGLE_MAPS_API_KEY') }}'); background-color: #333;"></div>
                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                        <span class="text-white/20 font-bold text-4xl">Interactive Map View</span>
                    </div>
                </div>

                <!-- List -->
                <div class="flex-1 overflow-y-auto p-4 space-y-4">
                    @if(empty($places) && !$isLoading)
                         <div class="text-center text-white/40 py-10">
                            Locations will appear here after generation.
                        </div>
                    @endif

                    @foreach($places as $place)
                        <div class="bg-white/5 hover:bg-white/10 p-4 rounded-xl border border-white/5 flex gap-4 transition-colors cursor-pointer animate-fade-in-up">
                            <div class="w-16 h-16 bg-white/10 rounded-lg flex items-center justify-center text-3xl">
                                {{ $place['emoji'] ?? '📍' }}
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <h4 class="text-white font-bold">{{ $place['name'] }}</h4>
                                    <span class="text-yellow-400 text-sm">★ {{ $place['rating'] ?? '4.5' }}</span>
                                </div>
                                <p class="text-white/40 text-sm mb-1">{{ $place['type'] ?? 'Place' }}</p>
                                <p class="text-primary-300 text-xs">{{ $place['distance'] ?? 'Nearby' }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
