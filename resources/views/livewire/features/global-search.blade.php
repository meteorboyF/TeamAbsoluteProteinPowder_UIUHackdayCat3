<div 
    x-data="{ 
        open: @entangle('isOpen'),
        toggle() { this.open = !this.open; if(this.open) setTimeout(() => $refs.searchInput.focus(), 50); }
    }"
    @keydown.window.prevent.cmd.k="toggle()"
    @keydown.window.prevent.ctrl.k="toggle()"
    @keydown.escape.window="open = false"
    style="display: none;"
    x-show="true"
>
    <!-- Trigger Button (Visible in UI) -->
    <button @click="toggle()" class="flex items-center gap-2 px-3 py-1.5 bg-gray-100 hover:bg-gray-200 rounded text-gray-500 text-sm border">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
        </svg>
        <span>Search...</span>
        <span class="text-xs bg-white border px-1 rounded text-gray-400">Ctrl K</span>
    </button>

    <!-- Modal Backdrop -->
    <div 
        x-show="open" 
        class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-start justify-center pt-20"
        x-transition.opacity
        @click.self="open = false"
    >
        <!-- Modal Content -->
        <div class="bg-white w-full max-w-lg rounded-xl shadow-2xl overflow-hidden" x-transition.scale>
            <div class="p-4 border-b flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
                <input 
                    x-ref="searchInput"
                    wire:model.live.debounce.300ms="query" 
                    type="text" 
                    class="flex-1 border-none focus:ring-0 text-lg text-gray-800 placeholder-gray-400"
                    placeholder="Search anything..." 
                />
                <button @click="open = false" class="text-gray-400 hover:text-gray-600 text-sm">Esc</button>
            </div>

            @if(count($results) > 0)
                <div class="py-2 max-h-96 overflow-y-auto">
                    <div class="px-4 py-1 text-xs font-bold text-gray-400 uppercase">Results</div>
                    @foreach($results as $result)
                        <button class="w-full text-left px-4 py-2 hover:bg-blue-50 flex items-center gap-3 group transition">
                            <div class="w-8 h-8 rounded bg-gray-100 flex items-center justify-center text-gray-500 group-hover:bg-blue-100 group-hover:text-blue-600">
                                @if(($result['icon'] ?? '') == 'user')
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5l-3.9 19.5m-2.1-19.5l-3.9 19.5" /></svg>
                                @endif
                            </div>
                            <div>
                                <div class="font-medium text-gray-800">{{ $result['title'] }}</div>
                                <div class="text-xs text-gray-500">{{ $result['type'] }}</div>
                            </div>
                        </button>
                    @endforeach
                </div>
            @elseif(strlen($query) >= 2)
                <div class="p-8 text-center text-gray-500">
                    <p>No results found for "{{ $query }}"</p>
                </div>
            @endif
            
            <div class="bg-gray-50 p-2 text-xs text-center text-gray-400 border-t">
                Search Users, Channels, and more
            </div>
        </div>
    </div>
</div>
