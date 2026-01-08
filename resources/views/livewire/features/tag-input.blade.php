<div class="relative">
    <div
        class="flex flex-wrap gap-2 items-center border p-2 rounded bg-white focus-within:ring-1 focus-within:ring-blue-500 ring-gray-300">
        @foreach($tags as $index => $tag)
            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded flex items-center gap-1">
                #{{ $tag }}
                <button wire:click="removeTag({{ $index }})" class="hover:text-blue-500 focus:outline-none">&times;</button>
            </span>
        @endforeach

        <input wire:model.live.debounce.200ms="newTag" wire:keydown.enter="addTag" type="text"
            class="flex-1 outline-none text-sm min-w-[100px]" placeholder="Add tag...">
    </div>

    <!-- Suggestions -->
    @if(count($suggestions) > 0)
        <div class="absolute z-10 w-full bg-white border shadow-lg rounded mt-1">
            @foreach($suggestions as $suggestion)
                <button wire:click="addTag('{{ $suggestion }}')"
                    class="block w-full text-left px-3 py-1.5 text-sm hover:bg-gray-100">
                    #{{ $suggestion }}
                </button>
            @endforeach
        </div>
    @endif
</div>