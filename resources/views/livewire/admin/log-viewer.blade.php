<div class="p-6 space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold font-display text-secondary-900">System Logs</h2>
        <div class="text-sm font-medium text-secondary-500 bg-secondary-100 px-3 py-1 rounded-full animate-pulse">
            Live Poll (5s)
        </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <x-ui.card>
            <div class="flex flex-col">
                <span class="text-secondary-500 text-sm font-medium uppercase tracking-wider">Total Logs</span>
                <span class="text-3xl font-bold text-secondary-900 mt-2">{{ \App\Models\Log::count() }}</span>
            </div>
        </x-ui.card>
    </div>

    <!-- Logs Table -->
    <div wire:poll.5s>
        <x-ui.card class="overflow-hidden">
            <x-ui.table :headers="['Time', 'Causer', 'Action', 'Subject', 'Details']">
                @forelse($logs as $log)
                    <tr class="hover:bg-secondary-50/50 transition-colors">
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                            <div class="font-medium text-secondary-900">{{ $log->created_at->diffForHumans() }}</div>
                            <div class="text-xs text-secondary-400 font-mono mt-0.5">{{ $log->created_at->format('H:i:s') }}</div>
                        </td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-secondary-500">
                            @if($log->causer)
                                <a href="{{ route('admin.impersonate', $log->causer_id) }}" class="font-medium text-primary-600 hover:text-primary-500 hover:underline">
                                    {{ class_basename($log->causer_type) }} #{{ $log->causer_id }}
                                </a>
                            @else
                                <span class="inline-flex items-center rounded-md bg-secondary-100 px-2 py-1 text-xs font-medium text-secondary-600">System</span>
                            @endif
                        </td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm font-medium text-secondary-900">
                            {{ $log->description }}
                        </td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-secondary-500">
                            @if($log->subject)
                                <span class="inline-flex items-center rounded bg-secondary-50 px-2 py-1 text-xs font-medium text-secondary-600 ring-1 ring-inset ring-secondary-500/10">
                                    {{ class_basename($log->subject_type) }} #{{ $log->subject_id }}
                                </span>
                            @else
                                <span class="text-secondary-300">-</span>
                            @endif
                        </td>
                        <td class="px-3 py-4 text-sm text-secondary-500">
                            @if($log->properties)
                                <code class="text-xs bg-secondary-50 text-secondary-600 px-2 py-1 rounded border border-secondary-200 block max-w-xs overflow-x-auto">
                                    {{ Str::limit(json_encode($log->properties), 50) }}
                                </code>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-3 py-8 text-center text-secondary-500 italic">
                            No logs found. Start doing something!
                        </td>
                    </tr>
                @endforelse
            </x-ui.table>
            
            <div class="border-t border-secondary-200 bg-secondary-50 px-4 py-3 sm:px-6">
                {{ $logs->links() }}
            </div>
        </x-ui.card>
    </div>
</div>