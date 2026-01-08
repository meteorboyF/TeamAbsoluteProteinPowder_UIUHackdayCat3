<div class="bg-white p-4 rounded shadow">
    <h3 class="font-bold text-gray-700 mb-4 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.675.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.675-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
        </svg>
        Inventory
    </h3>

    @if($items->count() > 0)
        <div class="grid grid-cols-4 gap-4">
            @foreach($items as $item)
                <div class="border rounded p-3 flex flex-col items-center text-center hover:shadow-md transition bg-gray-50">
                    <div class="text-3xl mb-2">{{ $item->icon }}</div>
                    <div class="text-sm font-bold text-gray-800">{{ $item->name }}</div>
                    <div class="text-xs text-gray-500 mb-2">{{ $item->type }}</div>
                    
                    <div class="mt-auto w-full">
                        <div class="text-xs font-bold bg-gray-200 rounded-full px-2 py-0.5 inline-block mb-2">x{{ $item->quantity }}</div>
                        <button 
                            wire:click="useItem('{{ $item->id }}')" 
                            class="w-full bg-blue-600 text-white text-xs py-1 rounded hover:bg-blue-700 disabled:opacity-50"
                            {{ $item->quantity <= 0 ? 'disabled' : '' }}
                        >
                            Use
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-8 text-gray-400 text-sm">
            Your inventory is empty.
        </div>
    @endif
</div>
