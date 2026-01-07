<div class="p-6 space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold font-display text-secondary-900">AI Persona Manager</h2>
        <span class="text-sm text-secondary-500">Configure the "Soul" of your chatbot.</span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Creator Form -->
        <div class="lg:col-span-1">
            <x-ui.card title="Create New Persona">
                <form wire:submit.prevent="create" class="space-y-4">
                    <x-ui.input label="Name" placeholder="e.g. Grumpy Wizard" wire:model="name" />
                    <x-ui.input label="Slug" placeholder="e.g. grumpy-wizard" wire:model="slug" />

                    <div>
                        <label class="block text-sm font-medium text-secondary-900 mb-1">System Prompt</label>
                        <textarea wire:model="system_prompt" rows="4"
                            class="w-full rounded-md border-secondary-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm"
                            placeholder="You are a helpful assistant..."></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-secondary-900 mb-1">Greeting</label>
                        <textarea wire:model="greeting_message" rows="2"
                            class="w-full rounded-md border-secondary-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm"
                            placeholder="Hello! How can I help?"></textarea>
                    </div>

                    <x-ui.button type="submit" class="w-full">Create Persona</x-ui.button>
                </form>
            </x-ui.card>
        </div>

        <!-- List -->
        <div class="lg:col-span-2">
            <x-ui.card title="Available Personas">
                <div class="space-y-4">
                    @forelse($personas as $persona)
                        <div
                            class="border rounded-lg p-4 {{ $persona->is_active ? 'border-green-500 bg-green-50' : 'border-secondary-200' }}">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-bold flex items-center gap-2">
                                        {{ $persona->name }}
                                        @if($persona->is_active)
                                            <span
                                                class="bg-green-100 text-green-800 text-xs px-2 py-0.5 rounded-full">Active</span>
                                        @endif
                                    </h3>
                                    <p class="text-xs text-secondary-500 font-mono mt-1">{{ $persona->slug }}</p>
                                </div>
                                @if(!$persona->is_active)
                                    <x-ui.button size="sm" wire:click="activate('{{ $persona->id }}')">Activate</x-ui.button>
                                @endif
                            </div>

                            <div class="mt-3 space-y-2">
                                <div>
                                    <span class="text-xs font-bold text-secondary-500 uppercase">System Prompt</span>
                                    <p
                                        class="text-sm text-secondary-700 bg-white p-2 rounded border border-secondary-100 italic">
                                        "{{ Str::limit($persona->system_prompt, 100) }}"
                                    </p>
                                </div>
                                <div>
                                    <span class="text-xs font-bold text-secondary-500 uppercase">Greeting</span>
                                    <p class="text-sm text-secondary-700">"{{ $persona->greeting_message }}"</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-secondary-500">
                            No personas defined. Create one to give your bot a personality.
                        </div>
                    @endforelse
                </div>
            </x-ui.card>
        </div>
    </div>
</div>