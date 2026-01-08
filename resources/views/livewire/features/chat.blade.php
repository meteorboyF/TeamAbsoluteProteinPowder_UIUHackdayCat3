<div class="flex flex-col h-[500px] bg-white rounded-lg shadow-lg border border-secondary-200"
    wire:poll.3s>
    <!-- Header -->
    <div class="p-4 border-b border-secondary-200 flex justify-between items-center bg-secondary-50 rounded-t-lg">
        <h3 class="font-bold text-secondary-800">Chat</h3>
        <div class="flex items-center gap-2">
            <span class="text-xs text-green-600 flex items-center gap-1 bg-green-50 px-2 py-1 rounded-full border border-green-200">
                <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span> Live
            </span>
            <div class="text-xs text-secondary-500">
                Context: {{ class_basename($model) }} #{{ $model->id }}
            </div>
        </div>
    </div>

    <!-- Messages Area -->
    <div class="flex-1 overflow-y-auto p-4 space-y-4 bg-secondary-50" id="chat-messages">
        @forelse($messages as $message)
            <div class="flex {{ $message->user_id == (auth()->id() ?? 'anon_user') ? 'justify-end' : 'justify-start' }}">
                <div
                    class="max-w-[80%] rounded-lg p-3 {{ $message->user_id == (auth()->id() ?? 'anon_user') ? 'bg-primary-600 text-white shadow-md' : 'bg-white text-secondary-800 shadow-sm border border-secondary-200' }}">
                    <div class="text-xs opacity-75 mb-1">{{ $message->user_id }}</div>
                    <div class="text-sm">{{ $message->body }}</div>
                    <div class="text-[10px] opacity-75 mt-1 text-right">
                        {{ $message->created_at->format('H:i') }}
                    </div>
                </div>
            </div>
        @empty
            <div class="h-full flex flex-col items-center justify-center text-secondary-400 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 mb-2 opacity-50">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                </svg>
                No messages yet. Start the conversation!
            </div>
        @endforelse
    </div>

    <!-- Input Area -->
    <div class="p-4 bg-white border-t border-secondary-200 rounded-b-lg">
        <div class="flex gap-2">
            <div class="flex-1">
                <x-ui.input placeholder="Type your message..." wire:model="newMessage"
                    wire:keydown.enter="sendMessage" />
            </div>
            <x-ui.button wire:click="sendMessage" variant="primary" icon="paper-airplane">
                Send
            </x-ui.button>
        </div>
    </div>

    <script>
        // Auto-scroll to bottom on update
        document.addEventListener('livewire:initialized', () => {
             const container = document.getElementById('chat-messages');
             if(container) container.scrollTop = container.scrollHeight;

             Livewire.hook('morph.updated', ({ el, component }) => {
                 const container = document.getElementById('chat-messages');
                 if (container) container.scrollTop = container.scrollHeight;
             });
        });
    </script>
</div>