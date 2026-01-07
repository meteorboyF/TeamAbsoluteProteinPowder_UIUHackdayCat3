<div class="p-4 border border-dashed border-gray-300 rounded-lg bg-gray-50">
    <!-- Drop Zone -->
    <div x-data="{ isDropping: false }" @dragover.prevent="isDropping = true" @dragleave.prevent="isDropping = false"
        @drop.prevent="isDropping = false; $refs.fileInput.files = $event.dataTransfer.files; $refs.fileInput.dispatchEvent(new Event('change'))"
        class="text-center py-6 transition rounded" :class="{ 'bg-blue-100 border-blue-400': isDropping }">
        <div class="mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto text-gray-400" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
            </svg>
        </div>
        <p class="text-sm text-gray-600">Drag & Drop files here or <label
                class="text-blue-600 cursor-pointer font-bold hover:underline">Browse<input x-ref="fileInput"
                    wire:model="photos" type="file" multiple class="hidden"></label></p>
        <p class="text-xs text-gray-400 mt-1">Supports Images, PDFs, Docs</p>

        <div wire:loading wire:target="photos" class="mt-2 text-sm text-blue-600">
            Uploading...
        </div>
    </div>

    <!-- Gallery / File List -->
    @if($uploads->count() > 0)
        <div class="mt-4 grid grid-cols-3 gap-4">
            @foreach($uploads as $file)
                <div class="relative group bg-white border rounded p-2 flex flex-col items-center">
                    @if(str_contains($file->mime_type, 'image'))
                        <div class="h-20 w-full bg-gray-100 mb-2 rounded overflow-hidden">
                            <!-- In real storage, asset($file->file_path) -->
                            <img src="https://placehold.co/100x100?text={{ $file->file_name }}"
                                class="object-cover w-full h-full opacity-50">
                        </div>
                    @else
                        <div class="h-20 w-full bg-gray-100 mb-2 flex items-center justify-center text-gray-500 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    @endif

                    <div class="text-xs text-center truncate w-full px-1">{{ $file->file_name }}</div>

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