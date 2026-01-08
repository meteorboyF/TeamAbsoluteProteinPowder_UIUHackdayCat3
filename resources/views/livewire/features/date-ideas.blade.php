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
                                @foreach(['Romantic', 'Adventurous', 'Chill', 'Luxury', 'Foodie'] as $vibe)
                                    <button class="px-4 py-2 rounded-full border border-white/10 bg-white/5 text-white hover:bg-primary-500 hover:border-primary-500 transition-colors text-sm">
                                        {{ $vibe }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-white/80 mb-2">Location</label>
                            <div class="relative">
                                <input type="text" value="New York, NY" class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white pl-10 focus:outline-none focus:ring-2 focus:ring-primary-500">
                                <span class="absolute left-3 top-3.5 text-white/50">📍</span>
                            </div>
                        </div>

                        <button class="w-full py-4 bg-gradient-to-r from-primary-500 to-pink-500 rounded-xl text-white font-bold shadow-lg shadow-primary-500/30">
                            ✨ Generate Perfect Date
                        </button>
                    </div>
                </div>

                <!-- AI Output -->
                <div class="bg-gradient-to-br from-indigo-900/40 to-purple-900/40 border border-white/10 rounded-3xl p-8">
                    <div class="flex items-start gap-4">
                        <div class="p-3 bg-white/10 rounded-xl">🤖</div>
                        <div>
                            <h3 class="text-xl font-bold text-white mb-2">AI Suggestion</h3>
                            <p class="text-white/80 leading-relaxed">
                                "Since you're feeling <span class="text-primary-300 font-bold">Adventurous</span>, I recommend starting with the hidden speakeasy 'The Back Room' for cocktails, then taking a walk across the Williamsburg Bridge at sunset. It's lively but intimate."
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Panel: Google Maps Style List -->
            <div class="bg-white/5 backdrop-blur-md rounded-3xl border border-white/10 overflow-hidden h-[800px] flex flex-col">
                <!-- Map Placeholder -->
                <div class="h-2/5 bg-gray-800 relative w-full overflow-hidden group">
                    <div class="absolute inset-0 bg-cover bg-center opacity-50 group-hover:opacity-70 transition-opacity" style="background-image: url('https://maps.googleapis.com/maps/api/staticmap?center=New+York,NY&zoom=13&size=600x300&maptype=roadmap&sensor=false&key=YOUR_API_KEY_HERE'); background-color: #333;"></div>
                    <!-- Mock Map UI -->
                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                        <span class="text-white/20 font-bold text-4xl">Interactive Map View</span>
                    </div>
                    <!-- Pins -->
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                        <span class="text-4xl drop-shadow-lg">🔴</span>
                    </div>
                    <div class="absolute top-1/3 left-1/3">
                        <span class="text-4xl drop-shadow-lg">📍</span>
                    </div>
                </div>

                <!-- List -->
                <div class="flex-1 overflow-y-auto p-4 space-y-4">
                    @foreach([
                        ['name' => 'The Back Room', 'type' => 'Speakeasy', 'rating' => 4.8, 'dist' => '0.5 mi', 'img' => '🍷'],
                        ['name' => 'Williamsburg Bridge', 'type' => 'Landmark', 'rating' => 4.9, 'dist' => '1.2 mi', 'img' => '🌉'],
                        ['name' => 'Lilia', 'type' => 'Italian Restaurant', 'rating' => 4.7, 'dist' => '2.0 mi', 'img' => '🍝'],
                        ['name' => 'Nitehawk Cinema', 'type' => 'Dine-In Theater', 'rating' => 4.6, 'dist' => '2.1 mi', 'img' => '🎬'],
                    ] as $place)
                        <div class="bg-white/5 hover:bg-white/10 p-4 rounded-xl border border-white/5 flex gap-4 transition-colors cursor-pointer">
                            <div class="w-16 h-16 bg-white/10 rounded-lg flex items-center justify-center text-3xl">
                                {{ $place['img'] }}
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <h4 class="text-white font-bold">{{ $place['name'] }}</h4>
                                    <span class="text-yellow-400 text-sm">★ {{ $place['rating'] }}</span>
                                </div>
                                <p class="text-white/40 text-sm mb-1">{{ $place['type'] }}</p>
                                <p class="text-primary-300 text-xs">{{ $place['dist'] }} away</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
