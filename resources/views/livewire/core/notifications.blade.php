<div class="relative" x-data="{ open: false }">
    <!-- Bell Icon -->
    <button @click="open = !open"
        class="relative p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        <span class="sr-only">View notifications</span>
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>

        @if($unreadCount > 0)
            <span class="absolute top-0 right-0 block h-2 w-2 rounded-full ring-2 ring-white bg-red-400"></span>
        @endif
    </button>

    <!-- Dropdown -->
    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="origin-top-right absolute right-0 mt-2 w-80 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50 overflow-hidden"
        style="display: none;">

        <div class="px-4 py-2 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Notifications</h3>
            @if($unreadCount > 0)
                <button wire:click="markAllRead" class="text-xs text-indigo-600 hover:text-indigo-500">Mark all
                    read</button>
            @endif
        </div>

        <div class="max-h-64 overflow-y-auto">
            @forelse($notifications as $notification)
                <div
                    class="px-4 py-3 border-b border-gray-50 hover:bg-gray-50 {{ !$notification->read_at ? 'bg-blue-50' : '' }}">
                    <div class="flex justify-between items-start">
                        <p class="text-sm font-medium text-gray-900">{{ $notification->title }}</p>
                        @if(!$notification->read_at)
                            <button wire:click="markAsRead('{{ $notification->id }}')"
                                class="ml-2 text-gray-400 hover:text-gray-600">
                                <span class="sr-only">Close</span>
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </button>
                        @endif
                    </div>
                    <p class="text-sm text-gray-500 mt-1">{{ $notification->body }}</p>
                    <p class="text-xs text-gray-400 mt-2">{{ $notification->created_at->diffForHumans() }}</p>
                </div>
            @empty
                <div class="px-4 py-6 text-center text-sm text-gray-500">
                    No notifications.
                </div>
            @endforelse
        </div>
    </div>
</div>