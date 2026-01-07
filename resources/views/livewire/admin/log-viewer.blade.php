<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-secondary-900 font-display">System Logs</h2>
            <p class="text-sm text-secondary-500">Monitoring system activities in real-time.</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="inline-flex items-center rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                Live Poll (5s)
            </span>
        </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <x-ui.card>
            <div class="flex items-center gap-4">
                <div class="p-2 bg-primary-50 rounded-lg">
                    <svg class="h-6 w-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-secondary-500">Total Logs</p>
                    <p class="text-2xl font-bold text-secondary-900 font-display">{{ \App\Models\Log::count() }}</p>
                </div>
            </div>
        </x-ui.card>
    </div>

    <!-- Logs Table -->
    <div wire:poll.5s>
        <x-ui.table :headers="['Time', 'Causer', 'Action', 'Subject', 'Details']">
            @forelse($logs as $log)
                <tr>
                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                        <div class="font-medium text-secondary-900">{{ $log->created_at->diffForHumans() }}</div>
                        <div class="text-xs text-secondary-500">{{ $log->created_at->format('H:i:s') }}</div>
                    </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm">
                        @if($log->causer)
                            <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">
                                {{ class_basename($log->causer_type) }} #{{ $log->causer_id }}
                            </span>
                        @else
                            <span class="text-secondary-400">System</span>
                        @endif
                    </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm font-medium text-secondary-900">
                        {{ $log->description }}
                    </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm">
                         @if($log->subject)
                            <span class="inline-flex items-center rounded-md bg-secondary-50 px-2 py-1 text-xs font-medium text-secondary-600 ring-1 ring-inset ring-secondary-500/10">
                                {{ class_basename($log->subject_type) }} #{{ $log->subject_id }}
                            </span>
                        @else
                            <span class="text-secondary-300">-</span>
                        @endif
                    </td>
                    <td class="px-3 py-4 text-sm text-secondary-500 font-mono text-xs">
                        @if($log->properties)
                            <span title="{{ json_encode($log->properties) }}">
                                {{ Str::limit(json_encode($log->properties), 40) }}
                            </span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="py-8 text-center text-sm text-secondary-500">
                        No logs found.
                    </td>
                </tr>
            @endforelse
        </x-ui.table>

        <div class="mt-4">
            {{ $logs->links() }}
        </div>
    </div>
</div>