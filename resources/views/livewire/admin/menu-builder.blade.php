<div class="p-6 space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold font-display text-secondary-900">Nav Menu Builder</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Form -->
        <div class="md:col-span-1">
            <x-ui.card title="Add Menu Item">
                <form wire:submit.prevent="create" class="space-y-4">
                    <x-ui.input label="Label" placeholder="e.g. Home" wire:model="label" />
                    <x-ui.input label="URL / Route" placeholder="e.g. /home" wire:model="url" />
                    <x-ui.button type="submit" class="w-full">Add Item</x-ui.button>
                </form>
            </x-ui.card>
        </div>

        <!-- List -->
        <div class="md:col-span-2">
            <x-ui.card title="Current Menu Items">
                <div class="space-y-2">
                    @foreach($items as $item)
                        <div
                            class="flex items-center justify-between p-3 border border-secondary-200 rounded-lg bg-secondary-50/50 hover:bg-white transition-colors">
                            <div class="flex items-center gap-4">
                                <span
                                    class="bg-secondary-200 text-secondary-600 px-2 py-1 rounded text-xs font-mono font-bold">{{ $item->order }}</span>
                                <div>
                                    <p class="font-bold text-secondary-900">{{ $item->label }}</p>
                                    <p class="text-xs text-secondary-500 font-mono">{{ $item->url }}</p>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button wire:click="moveUp('{{ $item->id }}')"
                                    class="p-1.5 text-secondary-500 hover:text-secondary-900 hover:bg-secondary-200 rounded transition-colors"
                                    title="Move Up">
                                    ⬆️
                                </button>
                                <button wire:click="delete('{{ $item->id }}')"
                                    class="p-1.5 text-red-500 hover:text-red-700 hover:bg-red-50 rounded transition-colors"
                                    title="Delete">
                                    🗑️
                                </button>
                            </div>
                        </div>
                    @endforeach

                    @if($items->isEmpty())
                        <div class="text-center py-8 text-secondary-400">
                            No menu items found. Add one on the left.
                        </div>
                    @endif
                </div>
            </x-ui.card>
        </div>
    </div>
</div>