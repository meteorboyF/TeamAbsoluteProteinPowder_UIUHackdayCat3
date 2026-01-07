<div class="p-6 space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold font-display text-secondary-900">Security & User Control</h2>
    </div>

    <!-- Maintenance Mode -->
    <x-ui.card title="Maintenance Mode">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-secondary-600">Put the site offline for non-admins.</p>
            </div>
            <x-ui.button wire:click="toggleMaintenance" variant="{{ $maintenanceMode ? 'danger' : 'primary' }}">
                {{ $maintenanceMode ? 'Enabled (Site Offline)' : 'Disabled (Live)' }}
            </x-ui.button>
        </div>
    </x-ui.card>

    <!-- User Management -->
    <x-ui.card title="User Management">
        <div class="mb-4">
            <x-ui.input wire:model.live="searchUser" placeholder="Search users by name or email..." />
        </div>

        <x-ui.table :headers="['Name', 'Email', 'Status', 'Action']">
            @foreach($users as $user)
                <tr>
                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-secondary-900 sm:pl-6">
                        {{ $user->name }}</td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-secondary-500">{{ $user->email }}</td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm">
                        @if($user->banned_at)
                            <span
                                class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">Banned</span>
                        @else
                            <span
                                class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Active</span>
                        @endif
                    </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm">
                        @if($user->id !== auth()->id())
                            <x-ui.button size="sm" variant="{{ $user->banned_at ? 'secondary' : 'danger' }}"
                                wire:click="toggleBan('{{ $user->id }}')">
                                {{ $user->banned_at ? 'Unban' : 'Ban User' }}
                            </x-ui.button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </x-ui.table>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </x-ui.card>
</div>