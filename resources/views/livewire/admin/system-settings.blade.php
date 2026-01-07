<div class="p-6 space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold font-display text-secondary-900">System Configuration</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- General Settings -->
        <x-ui.card title="General Settings">
            <form wire:submit.prevent="saveSettings" class="space-y-4">
                <x-ui.input label="Site Name" wire:model="siteName" />
                <x-ui.input label="Support Email" type="email" wire:model="supportEmail" />

                <div>
                    <label class="block text-sm font-medium leading-6 text-secondary-900 mb-1">Primary Color</label>
                    <div class="flex items-center gap-2">
                        <input type="color" wire:model="primaryColor"
                            class="h-10 w-20 rounded border border-secondary-300 cursor-pointer">
                        <span class="text-sm text-secondary-500">{{ $primaryColor }}</span>
                    </div>
                </div>

                <div class="pt-2">
                    <x-ui.button type="submit">Save Changes</x-ui.button>
                    @if (session()->has('message'))
                        <span class="text-green-600 text-sm ml-2 font-medium">{{ session('message') }}</span>
                    @endif
                </div>
            </form>
        </x-ui.card>

        <!-- Feature Flags -->
        <x-ui.card title="Feature Flags">
            <x-slot name="footer">
                @if($features->isEmpty())
                    <x-ui.button wire:click="createFeature" size="sm" variant="secondary">
                        Seed Defaults
                    </x-ui.button>
                @else
                    <p class="text-xs text-secondary-400">Toggle features to enable/disable them globally.</p>
                @endif
            </x-slot>

            <div class="space-y-4">
                @forelse($features as $feature)
                    <div
                        class="flex items-center justify-between border-b border-secondary-100 pb-2 last:border-0 last:pb-0">
                        <div>
                            <p class="font-medium text-secondary-900">{{ $feature->name }}</p>
                            <code
                                class="text-xs text-secondary-500 bg-secondary-100 px-1 py-0.5 rounded">{{ $feature->key }}</code>
                        </div>
                        <button wire:click="toggleFeature('{{ $feature->id }}')"
                            class="relative inline-flex items-center h-6 rounded-full w-11 transition-colors focus:outline-none {{ $feature->is_active ? 'bg-green-500' : 'bg-secondary-200' }}">
                            <span
                                class="{{ $feature->is_active ? 'translate-x-6' : 'translate-x-1' }} inline-block w-4 h-4 transform bg-white rounded-full transition-transform shadow"></span>
                        </button>
                    </div>
                @empty
                    <p class="text-secondary-500 text-sm">No feature flags defined.</p>
                @endforelse
            </div>
        </x-ui.card>
    </div>
</div>