<div class="p-6 bg-white rounded-xl shadow-lg border border-gray-100 max-w-2xl mx-auto font-sans">
    <div class="mb-6">
        <h2 class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-500 bg-clip-text text-transparent">Resonance Chamber</h2>
        <p class="text-sm text-gray-500 mb-2">Relationship Health</p>
        <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden shadow-inner">
            <div 
                class="h-full rounded-full transition-all duration-700 ease-out {{ $health > 50 ? 'bg-gradient-to-r from-green-400 to-green-600' : 'bg-gradient-to-r from-red-400 to-red-600' }}" 
                style="width: {{ $health }}%"
            ></div>
        </div>
        <div class="flex justify-between text-xs text-gray-400 mt-1">
            <span>Critical</span>
            <span>Stable</span>
            <span>Harmony</span>
        </div>
    </div>

    @if($auraAdvice)
        <div class="mb-6 p-4 bg-indigo-50 border-l-4 border-indigo-500 rounded-r-lg shadow-sm animate-fade-in-down">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-indigo-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-indigo-800">Aura Insight</h3>
                    <div class="mt-1 text-sm text-indigo-700">
                        {{ $auraAdvice }}
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="h-80 overflow-y-auto mb-6 p-4 bg-gray-50 rounded-lg border border-gray-100 shadow-inner space-y-3 custom-scrollbar">
        @if(empty($messages))
            <div class="text-center text-gray-400 italic mt-10">Start the conversation...</div>
        @endif
        @foreach($messages as $msg)
            <div class="flex flex-col {{ $msg['sender'] === 'me' ? 'items-end' : 'items-start' }}">
                <div class="max-w-xs md:max-w-md px-4 py-2 rounded-2xl shadow-sm {{ $msg['sender'] === 'me' ? 'bg-blue-600 text-white rounded-br-none' : 'bg-white text-gray-800 border border-gray-200 rounded-bl-none' }}">
                    <p class="text-sm">{{ $msg['content'] }}</p>
                </div>
                <span class="text-[10px] text-gray-400 mt-1 px-1">{{ $msg['created_at'] }}</span>
            </div>
        @endforeach
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-2 bg-purple-100 text-purple-700 rounded text-center text-sm">
            {{ session('message') }}
        </div>
    @endif

    <div class="relative">
        <div class="flex gap-3">
            <div class="relative flex-grow">
                <input 
                    type="text" 
                    wire:model="newMessage" 
                    wire:keydown.enter="sendMessage"
                    class="w-full border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition shadow-sm {{ $isLocked ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : '' }}" 
                    placeholder="{{ $isLocked ? 'Wait for their response...' : 'Type your message...' }}" 
                    {{ $isLocked ? 'disabled' : '' }}
                >
                @if($isLocked)
                    <div class="absolute right-3 top-3 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                @endif
            </div>
            
            <button 
                wire:click="sendMessage" 
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-xl transition shadow-md disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2"
                {{ $isLocked ? 'disabled' : '' }}
            >
                <span>Send</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
            </button>
        </div>
    </div>

    <div class="mt-6 pt-4 border-t border-gray-100 flex justify-between items-center bg-gray-50 -m-6 mb-0 p-4 rounded-b-xl">
        <div class="flex items-center gap-2">
            @if($isLocked)
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                    Listening Mode
                </span>
            @else
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    Your Turn
                </span>
            @endif
        </div>

        <button 
            wire:click="unlockChat"
            class="group relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300"
        >
            <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white rounded-md group-hover:bg-opacity-0 flex items-center gap-2">
                <svg class="w-4 h-4 text-purple-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                <span class="text-purple-600 group-hover:text-white font-semibold">Empathy Button</span>
            </span>
        </button>
    </div>
</div>

@script
<script>
    Echo.private('user.{{ auth()->id() }}')
        .listen('ChatUnlocked', (e) => {
            $wire.set('isLocked', false);
        });
</script>
@endscript
