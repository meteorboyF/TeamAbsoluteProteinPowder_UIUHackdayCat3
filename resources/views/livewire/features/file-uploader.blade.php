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

    <!-- File Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach($files as $file)
            <div class="group relative border border-secondary-200 rounded-lg p-2 hover:shadow-md transition bg-white">
                <div class="aspect-square bg-secondary-100 rounded flex items-center justify-center mb-2 overflow-hidden">
                    @if(in_array($file->mime_type, ['image/jpeg', 'image/png', 'image/webp']))
                        <img src="{{ Storage::url($file->file_path) }}" class="object-cover w-full h-full">
                    @else
                        <span class="text-2xl font-bold text-secondary-400">{{ strtoupper(pathinfo($file->file_name, PATHINFO_EXTENSION)) }}</span>
                    @endif
                    <button wire:click="deleteUpload('{{ $file->id }}')"
                        class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition"
                        title="Delete">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endforeach
        </div>
    @endif
</div>