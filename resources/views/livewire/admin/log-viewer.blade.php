<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">System Logs</h2>
        <div class="text-sm text-gray-500">Auto-refreshing every 5s</div>
    </div>

    <!-- Stats/Filters Section (Placeholder) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
            <div class="text-gray-500 text-sm">Total Logs</div>
            <div class="text-2xl font-bold">{{ \App\Models\Log::count() }}</div>
        </div>
    </div>

    <!-- Logs Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden" wire:poll.5s>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-gray-50 text-gray-800 font-semibold border-b">
                    <tr>
                        <th class="p-4">Time</th>
                        <th class="p-4">Causer</th>
                        <th class="p-4">Action</th>
                        <th class="p-4">Subject</th>
                        <th class="p-4">Details</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($logs as $log)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 whitespace-nowrap">
                                {{ $log->created_at->diffForHumans() }}
                                <div class="text-xs text-gray-400">{{ $log->created_at->format('H:i:s') }}</div>
                            </td>
                            <td class="p-4">
                                @if($log->causer)
                                    <span class="font-medium text-blue-600">{{ class_basename($log->causer_type) }}
                                        #{{ $log->causer_id }}</span>
                                @else
                                    <span class="text-gray-400">System</span>
                                @endif
                            </td>
                            <td class="p-4 font-medium text-gray-800">
                                {{ $log->description }}
                            </td>
                            <td class="p-4">
                                @if($log->subject)
                                    <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">
                                        {{ class_basename($log->subject_type) }} #{{ $log->subject_id }}
                                    </span>
                                @else
                                    <span class="text-gray-300">-</span>
                                @endif
                            </td>
                            <td class="p-4 text-xs font-mono text-gray-500">
                                @if($log->properties)
                                    <code>{{ json_encode($log->properties) }}</code>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-gray-500">
                                No logs found. Start doing something!
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t bg-gray-50">
            {{ $logs->links() }}
        </div>
    </div>
</div>