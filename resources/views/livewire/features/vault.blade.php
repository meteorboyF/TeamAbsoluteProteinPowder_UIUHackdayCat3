<div class="h-full">
    <!-- Header -->
    <div class="mb-8 flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h1 class="text-3xl font-bold text-secondary-900 dark:text-white font-display">The Vault</h1>
            <p class="mt-1 text-sm text-secondary-500 dark:text-secondary-400">Lock memories in time. Rub to reveal.</p>
        </div>
        <x-ui.button wire:click="$toggle('showUploadModal')" icon="heroicon-o-plus">
            Add Memory
        </x-ui.button>
    </div>

    @if(count($photos) > 0)
        <!-- Gallery Grid -->
        <div class="grid grid-cols-2 gap-6 md:grid-cols-3 lg:grid-cols-4">
            @foreach($photos as $photo)
                <div class="group relative aspect-[4/5] w-full overflow-hidden rounded-2xl bg-secondary-100 dark:bg-white/5 border border-secondary-200 dark:border-white/10 shadow-sm transition-all hover:shadow-md">
                    
                    <!-- Blurred Image -->
                    <img src="{{ $photo['url'] }}" 
                         alt="Memory" 
                         class="h-full w-full object-cover transition-all duration-700 ease-in-out blur-xl group-hover:blur-0 group-hover:scale-105"
                    >

                    <!-- Lock Overlay (Visible when blurred) -->
                    <div class="absolute inset-0 flex items-center justify-center transition-opacity duration-500 group-hover:opacity-0 bg-secondary-900/10 dark:bg-black/20">
                        <div class="rounded-full bg-white/20 p-3 backdrop-blur-sm border border-white/30 text-white">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Meta Overlay (Visible on Hover) -->
                    <div class="absolute inset-0 flex flex-col justify-end bg-gradient-to-t from-black/80 via-black/20 to-transparent p-4 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                        <p class="text-sm font-medium text-white">{{ $photo['date'] }}</p>
                        @if($photo['note'])
                            <p class="text-xs text-white/80 line-clamp-2">{{ $photo['note'] }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="flex h-96 flex-col items-center justify-center rounded-3xl border-2 border-dashed border-secondary-200 dark:border-white/10 bg-secondary-50/50 dark:bg-white/5 backdrop-blur-sm">
            <div class="mb-4 text-6xl">📸</div>
            <h3 class="text-lg font-medium text-secondary-900 dark:text-white">No memories yet</h3>
            <p class="mb-6 max-w-sm text-center text-sm text-secondary-500 dark:text-secondary-400">
                The Vault is empty. Upload your first secret memory to share it without words.
            </p>
            <x-ui.button wire:click="$toggle('showUploadModal')" variant="secondary">
                Add your first one
            </x-ui.button>
        </div>
    @endif

    <!-- Upload Modal -->
    <x-ui.modal wire:model="showUploadModal" title="Add a Secure Memory">
        <form wire:submit.prevent="save" class="space-y-4">
            
            <!-- File Input Area -->
            <div class="flex justify-center rounded-lg border border-dashed border-secondary-300 dark:border-white/20 px-6 py-10 bg-secondary-50 dark:bg-white/5">
                <div class="text-center">
                    <svg class="mx-auto h-12 w-12 text-secondary-300 dark:text-secondary-500" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                    </svg>
                    <div class="mt-4 flex text-sm leading-6 text-secondary-600 dark:text-secondary-400">
                        <label for="file-upload" class="relative cursor-pointer rounded-md font-semibold text-primary-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-primary-600 focus-within:ring-offset-2 hover:text-primary-500">
                            <span>Upload a file</span>
                            <input id="file-upload" wire:model="newPhoto" name="file-upload" type="file" class="sr-only">
                        </label>
                        <p class="pl-1">or drag and drop</p>
                    </div>
                    <p class="text-xs leading-5 text-secondary-500 dark:text-secondary-500">PNG, JPG, GIF up to 10MB</p>
                </div>
            </div>

            <!-- Date Picker -->
            <x-ui.input 
                label="Date"
                type="date"
                wire:model="date"
                required
            />

            <!-- Note Input -->
            <x-ui.textarea 
                label="Secret Note (Optional)"
                wire:model="note"
                placeholder="What made this moment special?"
                rows="3"
            />

            <div class="flex justify-end gap-3 pt-4">
                <x-ui.button type="button" variant="secondary" wire:click="$toggle('showUploadModal')">
                    Cancel
                </x-ui.button>
                <x-ui.button type="submit">
                    Lock in Vault
                </x-ui.button>
            </div>
        </form>
    </x-ui.modal>
</div>
