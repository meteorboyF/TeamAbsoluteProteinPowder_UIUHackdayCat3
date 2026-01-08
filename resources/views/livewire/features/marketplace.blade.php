<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-end mb-12">
            <div>
                <h1 class="text-4xl font-display font-bold text-white mb-2">The Bazaar</h1>
                <p class="text-white/60">Curated treasures for your special moments.</p>
            </div>
            <div class="mt-4 md:mt-0 relative">
                <input type="text" placeholder="Search gifts..." class="bg-white/5 border border-white/20 rounded-full px-6 py-2 text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-primary-500 w-full md:w-64">
                <span class="absolute right-4 top-2.5 text-white/40">🔍</span>
            </div>
        </div>

        <!-- Categories -->
        <div class="flex gap-4 overflow-x-auto pb-4 mb-8 no-scrollbar">
            @foreach(['All', 'Physical Gifts', 'Experiences', 'Digital', 'Flowers', 'Handmade'] as $cat)
                <button class="px-6 py-2 rounded-full border border-white/10 bg-white/5 text-white hover:bg-primary-500 hover:border-transparent transition-all whitespace-nowrap {{ $loop->first ? 'bg-primary-500 border-primary-500' : '' }}">
                    {{ $cat }}
                </button>
            @endforeach
        </div>

        <!-- Product Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $items = [
                    ['name' => 'Eternal Rose Box', 'price' => '$45.00', 'image' => '🌹', 'tag' => 'Best Seller'],
                    ['name' => 'Couple\'s Journal', 'price' => '$24.99', 'image' => '📖', 'tag' => 'Trending'],
                    ['name' => 'Distance Bracelets', 'price' => '$5.00', 'image' => '💍', 'tag' => 'Sale'],
                    ['name' => 'Starlight Projector', 'price' => '$59.00', 'image' => '✨', 'tag' => 'New'],
                    ['name' => 'Chocolate Truffles', 'price' => '$1.00', 'image' => '🍫', 'tag' => 'Classic'],
                    ['name' => 'Spa Gift Set', 'price' => '$2.00', 'image' => '🧖‍♀️', 'tag' => null],
                    ['name' => 'Custom Playlist Art', 'price' => '$85.00', 'image' => '🎵', 'tag' => 'Unique'],
                    ['name' => 'Weekend Getaway', 'price' => '$299.00', 'image' => '✈️', 'tag' => 'Experience'],
                ];
            @endphp

            @foreach($items as $item)
                <div class="bg-white/5 backdrop-blur-md rounded-2xl border border-white/10 overflow-hidden hover:transform hover:-translate-y-1 transition-all duration-300">
                    <div class="h-48 bg-black/20 flex items-center justify-center relative">
                        <span class="text-6xl">{{ $item['image'] }}</span>
                        @if($item['tag'])
                            <span class="absolute top-3 left-3 px-2 py-1 bg-primary-600 text-white text-xs font-bold uppercase rounded-md shadow-lg">{{ $item['tag'] }}</span>
                        @endif
                        <button class="absolute top-3 right-3 p-2 bg-black/40 rounded-full text-white/70 hover:text-red-500 transition-colors">♥</button>
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-white mb-1">{{ $item['name'] }}</h3>
                        <div class="flex justify-between items-center mt-4">
                            <span class="text-xl font-display font-bold text-primary-300">{{ $item['price'] }}</span>
                            <button class="p-2 bg-white text-black rounded-lg hover:bg-gray-200 transition-colors">
                                Add to Cart +
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
