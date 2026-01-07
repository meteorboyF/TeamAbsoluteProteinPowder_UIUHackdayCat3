<div class="relative" x-data="{ open: false }">
    <!-- Bell Icon -->
    <button @click="open = !open"
        class="relative p-2 rounded-full text-secondary-400 hover:text-secondary-500 hover:bg-secondary-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
        <span class="sr-only">View notifications</span>
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>

        @if($unreadCount > 0)
            <span class="absolute top-1.5 right-1.5 block h-2 w-2 rounded-full ring-2 ring-white bg-red-500"></span>
        @endif
    </button>

    <!-- Dropdown -->
    <div x-show="open" 
        @click.away="open = false" 
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95" 
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75" 
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="origin-top-right absolute right-0 mt-2 w-80 rounded-xl shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50 overflow-hidden"
        style="display: none;">

        <div class="px-4 py-3 border-b border-secondary-100 flex justify-between items-center bg-secondary-50/50">
            <h3 class="text-xs font-semibold text-secondary-500 uppercase tracking-wider font-display">Notifications</h3>
            @if($unreadCount > 0)
                <button wire:click="markAllRead" class="text-xs font-medium text-primary-600 hover:text-primary-700 transition-colors">
                    Mark all read
                </button>
            @endif
        </div>

        <div class="max-h-80 overflow-y-auto">
            @forelse($notifications as $notification)
                <div class="group px-4 py-3 border-b border-secondary-50 hover:bg-secondary-50 transition-colors {{ !$notification->read_at ? 'bg-primary-50/30' : '' }}">
                    <div class="flex justify-between items-start gap-2">
                        <p class="text-sm font-medium text-secondary-900 leading-tight">{{ $notification->title }}</p>
                        @if(!$notification->read_at)
                            <button wire:click="markAsRead('{{ $notification->id }}')"
                                class="text-secondary-400 hover:text-secondary-600 transition-colors"
                                title="Mark as read">
                                <span class="sr-only">Close</span>
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </button>
                        @endif
                    </div>
                    <p class="text-sm text-secondary-500 mt-1 line-clamp-2">{{ $notification->body }}</p>
                    <p class="text-xs text-secondary-400 mt-2">{{ $notification->created_at->diffForHumans() }}</p>
                </div>
            @empty
                <div class="px-4 py-8 text-center">
                    <svg class="mx-auto h-8 w-8 text-secondary-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <p class="mt-2 text-sm text-secondary-500">No notifications.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>