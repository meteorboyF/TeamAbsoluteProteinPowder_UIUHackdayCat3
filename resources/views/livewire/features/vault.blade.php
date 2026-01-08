<div class="h-full flex flex-col gap-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-secondary-900 dark:text-white font-display">The Vault</h1>
            <p class="text-sm text-secondary-500 dark:text-secondary-400">Secure your shared memories & secrets.</p>
        </div>
        <x-ui.button wire:click="$toggle('showUploadModal')" icon="heroicon-o-plus">
            Add Memory
        </x-ui.button>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-500/10 border border-green-500/20 text-green-500 p-3 rounded-lg text-sm">
            {{ session('message') }}
        </div>
    @endif

    <!-- Gallery Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($items as $item)
            @php
                $isLocked = $item['is_locked'];
                $blurClass = $isLocked ? 'blur-xl grayscale active:blur-0 active:grayscale-0 transition-all duration-700 cursor-pointer' : '';
            @endphp
            
            <div class="group relative aspect-square bg-secondary-100 dark:bg-white/5 rounded-2xl overflow-hidden border border-secondary-200 dark:border-white/10 shadow-sm hover:shadow-md transition-all">
                
                <!-- Content Layer -->
                @if($item['type'] === 'photo')
                    <img src="{{ $item['url'] }}" alt="Memory" class="w-full h-full object-cover {{ $blurClass }}">
                @else
                    <!-- Audio Representation -->
                     <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-indigo-500 to-purple-600 {{ $blurClass }}">
                        <svg class="w-16 h-16 text-white opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                        </svg>
                    </div>
                @endif

                <!-- Lock Overlay (if locked) -->
                @if($isLocked)
                    <div class="absolute inset-0 flex flex-col items-center justify-center z-10 pointer-events-none">
                        <div class="bg-black/60 backdrop-blur-sm p-4 rounded-full mb-3">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <span class="text-white font-bold text-shadow-sm px-4 text-center">
                            @if($item['unlock_type'] === 'date')
                                Opens {{ \Carbon\Carbon::parse($item['unlock_value'])->format('M d, Y') }}
                            @else
                                Opens at Level {{ $item['unlock_value'] }}
                            @endif
                        </span>
                        <p class="text-white/60 text-xs mt-2 uppercase tracking-widest">Hold to Peek</p>
                    </div>
                @endif

                <!-- Info Overlay (Bottom) -->
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                    <p class="text-white font-medium text-sm truncate">{{ $item['note'] }}</p>
                    @if($item['type'] === 'audio')
                         <div class="flex items-center gap-2 mt-2">
                            <div class="h-1 flex-1 bg-white/30 rounded-full overflow-hidden">
                                <div class="h-full w-1/3 bg-white"></div>
                            </div>
                            <span class="text-xs text-white/80">0:45</span>
                         </div>
                    @endif
                </div>
            </div>
        @endforeach

        <!-- Empty State -->
        @if(count($items) === 0)
            <div class="col-span-full py-12 flex flex-col items-center justify-center text-secondary-400 dark:text-secondary-500 border-2 border-dashed border-secondary-200 dark:border-white/10 rounded-2xl">
                <svg class="w-12 h-12 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <p>The vault is empty. Deposit a memory.</p>
            </div>
        @endif
    </div>

    <!-- Upload Modal -->
    <div x-show="$wire.showUploadModal" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm"
         x-transition.opacity
         style="display: none;">
        
        <div class="bg-white dark:bg-zinc-900 w-full max-w-lg rounded-2xl shadow-2xl border border-secondary-200 dark:border-white/10 overflow-hidden">
            <div class="p-6 border-b border-secondary-100 dark:border-white/5 flex justify-between items-center">
                <h3 class="font-bold text-lg text-secondary-900 dark:text-white">Sequester Memory</h3>
                <button wire:click="$toggle('showUploadModal')" class="text-secondary-400 hover:text-white">&times;</button>
            </div>
            
            <div class="p-6 space-y-6">
                <!-- Content Type -->
                <div class="flex gap-4">
                    <button wire:click="$set('newItemType', 'photo')" class="flex-1 py-2 rounded-lg border {{ $newItemType === 'photo' ? 'bg-primary-500 text-white border-primary-500' : 'border-secondary-200 dark:border-white/10 text-secondary-500' }}">
                        Photo
                    </button>
                    <button wire:click="$set('newItemType', 'audio')" class="flex-1 py-2 rounded-lg border {{ $newItemType === 'audio' ? 'bg-primary-500 text-white border-primary-500' : 'border-secondary-200 dark:border-white/10 text-secondary-500' }}">
                        Voice Note
                    </button>
                </div>

                @if($newItemType === 'photo')
                    <div>
                         <label class="block text-xs font-bold uppercase text-secondary-500 mb-2">Photo</label>
                         <div class="h-32 rounded-xl bg-secondary-100 dark:bg-white/5 border-2 border-dashed border-secondary-300 dark:border-white/10 flex items-center justify-center text-secondary-500">
                            <span>Click to browse...</span>
                         </div>
                    </div>
                @else
                    <div>
                        <label class="block text-xs font-bold uppercase text-secondary-500 mb-2">Recording</label>
                        <div class="flex items-center gap-4">
                            <button class="w-12 h-12 rounded-full bg-red-500 flex items-center justify-center text-white shadow-lg shadow-red-500/30">
                                <div class="w-4 h-4 bg-white rounded-sm"></div>
                            </button>
                            <span class="text-sm font-mono text-secondary-500">00:00 / 05:00</span>
                        </div>
                    </div>
                @endif

                <x-ui.input label="Note" wire:model="newItemNote" placeholder="A caption for this memory..." />
                
                <div class="grid grid-cols-2 gap-4">
                     <!-- Unlock Type -->
                     <div>
                        <label class="block text-xs font-bold uppercase text-secondary-500 mb-2">Unlock Condition</label>
                        <select wire:model.live="unlockType" class="w-full bg-secondary-50 dark:bg-white/5 border border-secondary-200 dark:border-white/10 rounded-lg p-2 text-sm text-secondary-900 dark:text-white">
                            <option value="date">Specific Date</option>
                            <option value="level">Relationship Level</option>
                        </select>
                     </div>

                     <!-- Unlock Value -->
                     <div>
                        <label class="block text-xs font-bold uppercase text-secondary-500 mb-2">
                            {{ $unlockType === 'date' ? 'Unlock Date' : 'Required Level' }}
                        </label>
                        @if($unlockType === 'date')
                             <input type="date" wire:model="unlockDate" class="w-full bg-secondary-50 dark:bg-white/5 border border-secondary-200 dark:border-white/10 rounded-lg p-2 text-sm text-secondary-900 dark:text-white">
                        @else
                             <input type="range" wire:model="unlockLevel" min="1" max="6" step="1" class="w-full accent-primary-500">
                             <div class="text-center text-sm font-bold text-primary-500 mt-1">Level {{ $unlockLevel }}</div>
                        @endif
                     </div>
                </div>

                <x-ui.button wire:click="save" class="w-full justify-center">
                    Lock in Vault
                </x-ui.button>
            </div>
        </div>
    </div>
</div>
