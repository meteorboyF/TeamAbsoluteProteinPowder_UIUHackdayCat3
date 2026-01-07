<div class="flex flex-col h-[500px] bg-white rounded-lg shadow-lg border border-secondary-200">
    <!-- Header -->
    <div class="p-4 border-b border-secondary-200 flex justify-between items-center bg-secondary-50 rounded-t-lg">
        <h3 class="font-bold text-secondary-800">Chat</h3>
        <div class="text-xs text-secondary-500">
            Context: {{ class_basename($model) }} #{{ $model->id }}
        </div>
    </div>

    <!-- Messages Area -->
    <div class="flex-1 overflow-y-auto p-4 space-y-4 bg-secondary-50" id="chat-messages">
        @forelse($messages as $message)
            <div class="flex {{ $message->user_id == (auth()->id() ?? 'anon') ? 'justify-end' : 'justify-start' }}">
                <div
                    class="max-w-[80%] rounded-lg p-3 {{ $message->user_id == (auth()->id() ?? 'anon') ? 'bg-primary-600 text-white' : 'bg-white text-secondary-800 shadow-sm border border-secondary-200' }}">
                    <div class="text-xs opacity-75 mb-1">{{ $message->user_id }}</div>
                    <div class="text-sm">{{ $message->body }}</div>
                    <div class="text-[10px] opacity-75 mt-1 text-right">
                        {{ $message->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-secondary-400 text-sm py-10">
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
            container.scrollTop = container.scrollHeight;

            Livewire.hook('morph.updated', ({ el, component }) => {
                if (container) container.scrollTop = container.scrollHeight;
            });
        });
    </script>
</div>