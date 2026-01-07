<div class="space-y-4">
    <h3 class="font-bold text-gray-700 mb-2">Activity Feed</h3>

    <div class="relative border-l-2 border-gray-200 ml-3 space-y-6 pb-4">
        @forelse($logs as $log)
            <div class="mb-8 flex items-center w-full">
                <!-- Dot -->
                <div class="absolute -left-[9px] w-4 h-4 bg-blue-500 rounded-full border-2 border-white"></div>

                <div class="ml-6 w-full">
                    <div class="text-sm text-gray-800">
                        <span class="font-bold text-gray-900">{{ $log->user->name ?? 'User #' . $log->user_id }}</span>
                        {{ $log->description }}
                    </div>
                    <div class="text-xs text-gray-500">
                        {{ $log->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        @empty
            <div class="ml-6 text-gray-400 italic text-sm">No recent activity.</div>
        @endforelse
    </div>

    @if($logs->count() >= $limit)
        <div class="text-center">
            <button wire:click="loadMore" class="text-sm text-blue-600 hover:underline">Load More</button>
        </div>
    @endif
</div>