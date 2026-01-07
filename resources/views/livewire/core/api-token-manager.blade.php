<div class="p-6 bg-white shadow rounded-lg">
    <h2 class="text-lg font-bold mb-4">API Tokens</h2>

    <div class="mb-6">
        <form wire:submit.prevent="create" class="flex gap-2">
            <input type="text" wire:model="name" placeholder="Token Name (e.g. My App)"
                class="border-gray-300 rounded shadow-sm flex-1">
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Generate</button>
        </form>
    </div>

    @if($showToken)
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded text-green-800">
            <p class="font-bold">Token Generated!</p>
            <p class="text-sm">Copy this now, you won't see it again:</p>
            <code class="block mt-2 bg-white p-2 rounded border">{{ $showToken }}</code>
        </div>
    @endif

    <div class="space-y-2">
        @foreach($tokens as $token)
            <div class="flex justify-between items-center p-3 border rounded bg-gray-50">
                <div>
                    <div class="font-bold">{{ $token->name }}</div>
                    <div class="text-xs text-gray-500">Created {{ $token->created_at->diffForHumans() }}</div>
                </div>
                <button wire:click="delete('{{ $token->id }}')" class="text-red-600 text-sm hover:underline">Revoke</button>
            </div>
        @endforeach
    </div>
</div>