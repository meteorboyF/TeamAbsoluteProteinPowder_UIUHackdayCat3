<div class="p-4 bg-white border rounded shadow-sm">
    @if(!$poll)
        @if($isCreating)
            <!-- Creator Mode -->
            <div class="space-y-3">
                <input wire:model="newQuestion" type="text" class="w-full border p-2 rounded font-bold"
                    placeholder="Ask a question...">

                @foreach($newOptions as $index => $option)
                    <div class="flex gap-2">
                        <input wire:model="newOptions.{{ $index }}" type="text" class="flex-1 border p-1 rounded text-sm"
                            placeholder="Option {{ $index + 1 }}">
                        @if(count($newOptions) > 2)
                            <button wire:click="removeOption({{ $index }})" class="text-red-500">&times;</button>
                        @endif
                    </div>
                @endforeach

                <button wire:click="addOption" class="text-xs text-blue-500">+ Add Option</button>

                <div class="flex gap-2 pt-2">
                    <button wire:click="createPoll" class="bg-blue-600 text-white px-4 py-1 rounded text-sm">Create
                        Poll</button>
                    <button wire:click="$set('isCreating', false)" class="text-gray-500 text-sm">Cancel</button>
                </div>
            </div>
        @else
            <button wire:click="$set('isCreating', true)" class="flex items-center gap-2 text-gray-500 hover:text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                </svg>
                Create Poll
            </button>
        @endif
    @else
        <!-- View Mode -->
        <h3 class="font-bold text-lg mb-4">{{ $poll->question }}</h3>
        <div class="space-y-3">
            @foreach($poll->options as $index => $option)
                @php
                    $count = $results[$index] ?? 0;
                    $percent = $totalVotes > 0 ? ($count / $totalVotes) * 100 : 0;
                    $myVote = ($poll->votes[auth()->id() ?? 'anon_user'] ?? -1) == $index;
                @endphp

                <button wire:click="vote({{ $index }})"
                    class="relative w-full border rounded-lg p-3 text-left overflow-hidden hover:border-blue-400 group">
                    <!-- Progress Bar Background -->
                    <div class="absolute inset-0 bg-blue-50 transition-all duration-500" style="width: {{ $percent }}%"></div>

                    <div class="relative flex justify-between z-10">
                        <span class="font-medium {{ $myVote ? 'text-blue-700 font-bold' : 'text-gray-700' }}">
                            {{ $option }}
                            @if($myVote) <span class="text-xs ml-1">(You)</span> @endif
                        </span>
                        <span class="text-sm text-gray-500">{{ round($percent) }}% ({{ $count }})</span>
                    </div>
                </button>
            @endforeach
        </div>
        <div class="text-xs text-gray-400 mt-3 text-right">{{ $totalVotes }} total votes</div>
    @endif
</div>