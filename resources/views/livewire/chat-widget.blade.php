<div class="fixed bottom-6 right-6 z-50 flex flex-col items-end space-y-4 font-sans">
    <!-- Chat Window -->
    <div x-show="$wire.isOpen" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 scale-95"
        class="bg-white w-80 sm:w-96 rounded-2xl shadow-2xl border border-gray-100 overflow-hidden flex flex-col"
        style="display: none; height: 500px; max-height: 80vh;">

        <!-- Header -->
        <div class="bg-primary-600 p-4 text-white flex justify-between items-center shadow-md">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-full bg-white/20 flex items-center justify-center text-xl">
                    🤖
                </div>
                <div>
                    <h3 class="font-bold text-sm leading-tight">{{ $persona?->name ?? 'System Bot' }}</h3>
                    <div class="flex items-center gap-1.5 opacity-80">
                        <span class="h-2 w-2 rounded-full bg-green-400"></span>
                        <span class="text-xs">Online</span>
                    </div>
                </div>
            </div>
            <button wire:click="toggle" class="text-white/80 hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <!-- Messages -->
        <div class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50 text-sm" id="chat-messages">
            @if(!$persona)
                <div class="text-center text-gray-500 text-xs py-8">
                    Bot is currently sleeping (No active persona).
                </div>
            @endif

            @if($persona && $messages->isEmpty())
                <div class="flex justify-start">
                    <div
                        class="max-w-[85%] rounded-2xl rounded-tl-none px-4 py-2.5 bg-white text-gray-700 shadow-sm border border-gray-100">
                        {{ $persona->greeting_message }}
                    </div>
                </div>
            @endif

            @foreach($messages as $msg)
                    <div class="flex {{ $msg->role === 'user' ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-[85%] rounded-2xl px-4 py-2.5 shadow-sm 
                                {{ $msg->role === 'user'
                ? 'bg-primary-600 text-white rounded-tr-none'
                : 'bg-white text-gray-700 border border-gray-100 rounded-tl-none' 
                                }}">
                            {!! Str::markdown($msg->content) !!}
                        </div>
                    </div>
            @endforeach
        </div>

        <!-- Input -->
        <div class="p-4 bg-white border-t border-gray-100">
            <form wire:submit.prevent="sendMessage" class="relative">
                <input type="text" wire:model="input" placeholder="Type a message..."
                    class="w-full pl-4 pr-12 py-3 rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-primary-500 focus:ring-primary-500 transition-all text-sm"
                    {{ !$persona ? 'disabled' : '' }}>
                <button type="submit"
                    class="absolute right-2 top-1.5 p-1.5 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                    {{ !$persona ? 'disabled' : '' }}>
                    <svg class="w-4 h-4 transform rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <!-- Launcher Button -->
    <button wire:click="toggle"
        class="h-14 w-14 rounded-full bg-primary-600 text-white shadow-lg shadow-primary-600/30 hover:bg-primary-700 hover:scale-110 active:scale-95 transition-all duration-300 flex items-center justify-center group">
        <span
            class="absolute inline-flex h-full w-full rounded-full bg-primary-400 opacity-0 group-hover:animate-ping"></span>
        <div x-show="!$wire.isOpen">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                </path>
            </svg>
        </div>
        <div x-show="$wire.isOpen" style="display: none;">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </div>
    </button>
</div>