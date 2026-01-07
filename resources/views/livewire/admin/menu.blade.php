<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-secondary-900 font-display">Menu Builder</h2>
            <p class="text-sm text-secondary-500">Organize and customize the application navigation.</p>
        </div>
        <x-ui.button>
            <x-slot name="icon">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </x-slot>
            Add Menu Item
        </x-ui.button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Menu List (Draggable) -->
        <div class="lg:col-span-2 space-y-4">
            <!-- Simulated Sortable List -->
            @foreach(['Dashboard', 'Projects', 'Tasks', 'Team', 'Settings'] as $item)
                <div class="group flex items-center bg-white border border-secondary-200 rounded-lg p-3 hover:border-primary-300 hover:shadow-sm transition-all cursor-move">
                    <!-- Drag Handle -->
                    <div class="mr-3 text-secondary-400 cursor-move group-hover:text-primary-500">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
                        </svg>
                    </div>
                    
                    <div class="flex-1">
                        <span class="font-medium text-secondary-900">{{ $item }}</span>
                        <span class="text-xs text-secondary-400 ml-2">/{{ Str::slug($item) }}</span>
                    </div>

                    <div class="flex items-center gap-2 opacity-50 group-hover:opacity-100 transition-opacity">
                        <button class="p-1 text-secondary-400 hover:text-primary-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </button>
                        <button class="p-1 text-secondary-400 hover:text-red-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Sidebar / Instructions -->
        <div class="space-y-6">
            <x-ui.card title="Structure">
                <p class="text-sm text-secondary-500">
                    Drag items to reorder them. Click the edit icon to change labels or URLs.
                </p>
                <div class="mt-4 p-4 bg-secondary-50 rounded text-xs text-secondary-600 font-mono border border-secondary-200">
                    Menus are cached. Changes may take up to 1 minute to reflect on the frontend.
                </div>
            </x-ui.card>
        </div>
    </div>
</div>
