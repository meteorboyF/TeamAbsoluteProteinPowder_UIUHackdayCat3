<div>
    <h2 class="text-2xl font-bold mb-4">My Support Tickets</h2>
    <a href="{{ route('tickets.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">New
        Ticket</a>

    <div class="bg-white shadow overflow-hidden sm:rounded-md mt-4">
        <ul class="divide-y divide-gray-200">
            @forelse($tickets as $ticket)
                <li>
                    <a href="{{ route('tickets.show', $ticket->id) }}" class="block hover:bg-gray-50">
                        <div class="px-4 py-4 flex items-center sm:px-6">
                            <div class="min-w-0 flex-1 sm:flex sm:items-center sm:justify-between">
                                <div class="truncate">
                                    <div class="flex text-sm">
                                        <p class="font-medium text-indigo-600 truncate">{{ $ticket->subject }}</p>
                                        <p class="ml-1 flex-shrink-0 font-normal text-gray-500">#{{ $ticket->id }}</p>
                                    </div>
                                    <div class="mt-2 flex">
                                        <div class="flex items-center text-sm text-gray-500">
                                            <p>Opened {{ $ticket->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ml-5 flex-shrink-0">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $ticket->status === 'open' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($ticket->status) }}
                                </span>
                            </div>
                        </div>
                    </a>
                </li>
            @empty
                <li class="px-4 py-4 text-center text-gray-500">No tickets found.</li>
            @endforelse
        </ul>
    </div>
</div>