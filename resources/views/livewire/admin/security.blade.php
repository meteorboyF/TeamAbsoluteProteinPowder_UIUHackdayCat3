<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-secondary-900 font-display">Security & Access</h2>
            <p class="text-sm text-secondary-500">Manage blocked users and IP restrictions.</p>
        </div>
        <x-ui.button variant="danger" @click="$dispatch('open-modal', 'ban-user-modal')">
            Ban New User
        </x-ui.button>
    </div>

    <!-- Banned Users Table -->
    <x-ui.card title="Banned Entities" class="border-red-100 ring-1 ring-red-50">
        <x-ui.table :headers="['User / IP', 'Reason', 'Banned At', 'Expires', 'Action']">
            <!-- Simulated Data -->
            <tr class="group hover:bg-red-50/30 transition-colors">
                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-secondary-900 sm:pl-6 flex items-center gap-3">
                    <span class="h-8 w-8 rounded-full bg-red-100 flex items-center justify-center text-red-600">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                        </svg>
                    </span>
                    <div>
                        <div>spammer@example.com</div>
                        <div class="text-xs text-secondary-500 font-mono">192.168.1.50</div>
                    </div>
                </td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-red-600 font-medium">Spamming Comments</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-secondary-500">2 hours ago</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-secondary-900">Permanent</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm">
                    <x-ui.button variant="ghost" size="sm" class="text-secondary-500 hover:text-green-600">Unban</x-ui.button>
                </td>
            </tr>

            <tr class="group hover:bg-red-50/30 transition-colors">
                 <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-secondary-900 sm:pl-6 flex items-center gap-3">
                    <span class="h-8 w-8 rounded-full bg-red-100 flex items-center justify-center text-red-600">
                         <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.2-2.92.577-4.247M9.81 16.658c.31-.1.618-.212.92-.338" />
                        </svg>
                    </span>
                    <div>
                        <div>Suspicious Bot</div>
                        <div class="text-xs text-secondary-500 font-mono">45.22.19.112</div>
                    </div>
                </td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-red-600 font-medium">Brute Force Attempt</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-secondary-500">1 day ago</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-secondary-900">7 days</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm">
                    <x-ui.button variant="ghost" size="sm" class="text-secondary-500 hover:text-green-600">Unban</x-ui.button>
                </td>
            </tr>
        </x-ui.table>
    </x-ui.card>

    <!-- Ban Modal -->
    <x-ui.modal name="ban-user-modal" title="Ban User">
        <div class="space-y-4">
            <x-ui.alert type="warning">
                This action will immediately restrict access for the specified user or IP.
            </x-ui.alert>
            <x-ui.input label="User Email or IP Address" placeholder="e.g. user@example.com" />
            <x-ui.select label="Duration">
                <option>24 Hours</option>
                <option>7 Days</option>
                <option>Permanent</option>
            </x-ui.select>
            <x-ui.textarea label="Reason for Ban" placeholder="Violation of terms..." />
        </div>
        <x-slot name="footer">
            <x-ui.button variant="danger">Ban User</x-ui.button>
            <x-ui.button variant="secondary" @click="$dispatch('close-modal', 'ban-user-modal')">Cancel</x-ui.button>
        </x-slot>
    </x-ui.modal>
</div>
