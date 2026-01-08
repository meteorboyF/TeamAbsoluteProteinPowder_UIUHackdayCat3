<div x-data>
    <div class="flex justify-between items-center mb-4">
        <h3 class="font-bold text-secondary-700">Attachments</h3>
        <x-ui.button 
            @click="$dispatch('open-modal', 'upload-modal-{{ $model->id }}')" 
            variant="secondary" 
            size="sm"
            icon="plus"
        >
            Add File
        </x-ui.button>
    </div>

    <!-- File Grid (Preview) -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach($uploads ?? $files as $file)
            <div class="group relative border border-secondary-200 rounded-lg p-2 hover:shadow-md transition bg-white">
                <div class="aspect-square bg-secondary-100 rounded flex items-center justify-center mb-2 overflow-hidden relative">
                    @if(in_array($file->mime_type, ['image/jpeg', 'image/png', 'image/webp']))
                        <img src="{{ Storage::url($file->file_path) }}" class="object-cover w-full h-full">
                    @else
                        <span class="text-2xl font-bold text-secondary-400">{{ strtoupper(pathinfo($file->file_name, PATHINFO_EXTENSION)) }}</span>
                    @endif
                    
                    <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                        <button wire:click="deleteUpload('{{ $file->id }}')" class="bg-red-500 text-white p-1 rounded-full hover:bg-red-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="text-xs text-center truncate w-full px-1 text-secondary-600">{{ $file->file_name }}</div>
            </div>
        @endforeach
    </div>

    <!-- Upload Modal -->
    <x-ui.modal name="upload-modal-{{ $model->id }}" title="Upload Files">
        <div class="p-4 border-2 border-dashed border-secondary-300 rounded-lg bg-secondary-50 hover:bg-secondary-100 transition"
             x-data="{ isDropping: false }" 
             @dragover.prevent="isDropping = true" 
             @dragleave.prevent="isDropping = false"
             @drop.prevent="isDropping = false; $refs.fileInput.files = $event.dataTransfer.files; $refs.fileInput.dispatchEvent(new Event('change'))"
             :class="{ 'border-primary-500 bg-primary-50': isDropping }">
            
            <div class="text-center py-8">
                <div class="mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto text-secondary-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                </div>
                <p class="text-sm text-secondary-600 font-medium">Drag & Drop files here</p>
                <p class="text-xs text-secondary-400 my-2">- OR -</p>
                <label class="cursor-pointer">
                    <span class="bg-white border border-secondary-300 text-secondary-700 px-3 py-1.5 rounded-md text-sm hover:border-primary-500 hover:text-primary-600 transition shadow-sm">
                        Browse Files
                    </span>
                    <input x-ref="fileInput" wire:model="photos" type="file" multiple class="hidden">
                </label>
            </div>

            <div wire:loading wire:target="photos" class="mt-2 text-center">
                <span class="text-sm text-primary-600 font-medium animate-pulse">Uploading...</span>
            </div>
        </div>

        <x-slot name="footer">
            <x-ui.button variant="secondary" @click="$dispatch('close-modal', 'upload-modal-{{ $model->id }}')">
                Done
            </x-ui.button>
        </x-slot>
    </x-ui.modal>
</div>