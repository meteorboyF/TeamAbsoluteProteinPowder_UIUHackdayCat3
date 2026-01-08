<div class="bg-white rounded-lg shadow p-4">
    <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-red-500">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
        </svg>
        Upcoming Events
    </h3>

    <div class="space-y-3">
        @forelse($events as $event)
            <div class="flex gap-3 items-start border-l-4 border-red-500 pl-3">
                <div class="text-center bg-gray-100 rounded p-1 min-w-[50px]">
                    <div class="text-xs text-red-600 font-bold uppercase">{{ $event->start_at->format('M') }}</div>
                    <div class="text-lg font-bold text-gray-800">{{ $event->start_at->format('d') }}</div>
                </div>
                <div>
                    <div class="font-bold text-gray-800 text-sm">{{ $event->title }}</div>
                    <div class="text-xs text-gray-500">{{ $event->start_at->format('h:i A') }} • {{ $event->location }}</div>
                </div>
            </div>
        @empty
            <div class="text-sm text-gray-400 italic">No upcoming events.</div>
        @endforelse
    </div>
</div>
