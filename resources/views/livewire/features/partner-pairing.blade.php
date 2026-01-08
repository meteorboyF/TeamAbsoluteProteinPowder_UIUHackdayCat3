<div>
    @if(auth()->user()->partner_id)
        <x-ui.card>
            <div class="text-center py-6">
                <div class="text-6xl mb-4">💑</div>
                <p class="text-lg font-bold text-secondary-900">
                    Paired with {{ auth()->user()->partner->name }}
                </p>
            </div>
        </x-ui.card>
    @else
        <x-ui.card title="Pair with Your Partner">
            <div class="space-y-6">
                <div>
                    <p class="text-sm text-secondary-600 mb-2">Your Pairing Code:</p>
                    <div class="bg-purple-50 border-2 border-purple-200 rounded-lg p-4 text-center">
                        <p class="text-3xl font-bold text-purple-600 tracking-widest">{{ $this->myCode }}</p>
                    </div>
                    <p class="text-xs text-secondary-500 mt-2">Share this code with your partner</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-secondary-700 mb-2">
                        Enter Partner's Code:
                    </label>
                    <input type="text" wire:model="pairingCode"
                        class="block w-full rounded-lg border-secondary-300 uppercase tracking-widest text-center text-2xl font-bold"
                        placeholder="ABC123" maxlength="6">
                </div>

                <x-ui.button wire:click="pair" variant="primary" class="w-full">
                    Pair Now
                </x-ui.button>

                @if(session()->has('message'))
                    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                        {{ session('message') }}
                    </div>
                @endif

                @if(session()->has('error'))
                    <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </x-ui.card>
    @endif
</div>