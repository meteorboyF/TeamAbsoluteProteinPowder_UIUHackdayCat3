<div class="flex flex-col h-[500px] border rounded-lg bg-gray-50 shadow-sm overflow-hidden">
    <!-- Header -->
    <div class="bg-white p-4 border-b flex justify-between items-center">
        <h3 class="font-bold text-gray-700">Chat</h3>
        <span class="text-xs text-green-500 flex items-center gap-1">
            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span> Live
        </span>
    </div>

    <!-- Messages Area -->
    <div wire:poll.1s class="flex-1 overflow-y-auto p-4 space-y-3 flex flex-col" id="chat-container={{ $model->id }}">
        @forelse($messages as $message)
            <div
                class="flex flex-col {{ $message->user_id == (auth()->id() ?? 'anon_user') ? 'items-end' : 'items-start' }}">
                <div class="max-w-[75%] rounded-lg px-4 py-2 text-sm 
                        {{ $message->user_id == (auth()->id() ?? 'anon_user')
            ? 'bg-blue-600 text-white rounded-br-none'
            : 'bg-white border border-gray-200 text-gray-800 rounded-bl-none' 
                        }}">
                    {{ $message->body }}
                </div>
                <span class="text-[10px] text-gray-400 mt-1">
                    {{ $message->created_at->format('H:i') }} • {{ $message->user_id }}
                </span>
            </div>
        @empty
            <div class="flex h-full items-center justify-center text-gray-400 text-sm">
                No messages yet. Start the conversation!
            </div>
        @endforelse
    </div>

    <!-- Input Area -->
    <div class="p-4 bg-white border-t">
        <form wire:submit.prevent="sendMessage" class="flex gap-2">
            <input type="text" wire:model="newMessage"
                class="flex-1 rounded-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 px-4 py-2 text-sm shadow-sm"
                placeholder="Type a message...">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white rounded-full p-2 px-4 shadow transition disabled:opacity-50"
                wire:loading.attr="disabled">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                </svg>
            </button>
        </form>
    </div>
</div>