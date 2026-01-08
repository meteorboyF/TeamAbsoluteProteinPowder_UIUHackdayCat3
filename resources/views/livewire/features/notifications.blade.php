<div wire:poll.5s="updateCount" class="relative cursor-pointer group">
    <!-- Icon -->
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
        class="w-6 h-6 text-gray-600 group-hover:text-blue-600 transition">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
    </svg>

    <!-- Badge -->
    @if($unreadCount > 0)
        <span
            class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-[10px] text-white animate-pulse">
            {{ $unreadCount > 9 ? '9+' : $unreadCount }}
        </span>

        <!-- Dropdown Preview (Hover) -->
        <div class="absolute right-0 top-8 w-64 bg-white shadow-xl rounded-lg border hidden group-hover:block p-3 z-50">
            <p class="text-xs font-bold text-gray-400 mb-2 uppercase">Recent Activity</p>
            <div class="text-sm text-gray-600">
                You have {{ $unreadCount }} new updates in the timeline.
            </div>
            <div class="mt-2 text-center border-t pt-2">
                <a href="#" class="text-xs text-blue-500 hover:underline">View All</a>
            </div>
        </div>
    @endif
</div>