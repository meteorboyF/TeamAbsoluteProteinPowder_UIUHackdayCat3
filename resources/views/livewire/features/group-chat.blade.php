<div class="h-screen flex bg-gray-100">
    <!-- Sidebar -->
    <div class="w-64 bg-gray-800 text-white flex flex-col">
        <div class="p-4 font-bold text-xl border-b border-gray-700">Team Channels</div>

        <div class="flex-1 overflow-y-auto p-4 space-y-2">
            <h4 class="text-xs text-gray-500 uppercase font-semibold">Channels</h4>
            @foreach($channels as $channel)
                <button wire:click="$set('channelId', '{{ $channel->id }}')"
                    class="block w-full text-left px-2 py-1 rounded hover:bg-gray-700 {{ $currentChannel && $currentChannel->id == $channel->id ? 'bg-blue-600' : '' }}">
                    # {{ $channel->name }}
                </button>
            @endforeach

            <!-- Create New Channel -->
            <div class="mt-4 pt-4 border-t border-gray-700">
                @if($isCreating)
                    <input wire:model="newChannelName" wire:keydown.enter="createChannel" type="text"
                        class="w-full text-black px-2 py-1 rounded text-sm" placeholder="Enter name..." autofocus>
                @else
                    <button wire:click="$set('isCreating', true)"
                        class="flex items-center text-gray-400 hover:text-white text-sm">
                        <span class="mr-2">+</span> Add Channel
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Main Chat Area -->
    <div class="flex-1 flex flex-col">
        @if($currentChannel)
            <!-- Header -->
            <div class="bg-white p-4 shadow-sm border-b flex justify-between items-center">
                <h3 class="font-bold text-gray-800"># {{ $currentChannel->name }}</h3>
                <span class="text-xs text-gray-500">{{ count($currentChannel->member_ids ?? []) }} members</span>
            </div>

            <!-- Messages -->
            <div wire:poll.1s class="flex-1 overflow-y-auto p-6 space-y-4">
                @forelse($messages as $message)
                    <div
                        class="flex items-start gap-4 {{ $message->user_id == (auth()->id() ?? 'anon_user') ? 'flex-row-reverse' : '' }}">
                        <div
                            class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-xs font-bold shrink-0">
                            {{ substr($message->user_id, 0, 2) }}
                        </div>
                        <div
                            class="flex flex-col max-w-[70%] {{ $message->user_id == (auth()->id() ?? 'anon_user') ? 'items-end' : 'items-start' }}">
                            <div class="text-xs text-gray-500 mb-1 flex gap-2">
                                <span class="font-bold">{{ $message->user_id }}</span>
                                <span>{{ $message->created_at->format('H:i') }}</span>
                            </div>
                            <div
                                class="px-4 py-2 rounded-lg text-sm {{ $message->user_id == (auth()->id() ?? 'anon_user') ? 'bg-blue-600 text-white' : 'bg-white shadow-sm text-gray-800' }}">
                                {{ $message->body }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-400 mt-10">
                        <p>This is the start of #{{ $currentChannel->name }}.</p>
                    </div>
                @endforelse
            </div>

            <!-- Input -->
            <div class="p-4 bg-white border-t">
                <form wire:submit.prevent="sendMessage" class="flex gap-4">
                    <input wire:model="newMessage" type="text"
                        class="flex-1 border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-3 shadow-sm"
                        placeholder="Message #{{ $currentChannel->name }}">
                    <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 font-medium">Send</button>
                </form>
            </div>
        @else
            <div class="flex-1 flex items-center justify-center text-gray-500">
                Select a channel to start chatting
            </div>
        @endif
    </div>
</div>