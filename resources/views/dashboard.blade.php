<x-app-layout>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold tracking-tight text-secondary-900 font-display">Dashboard</h1>
        </div>

        <x-ui.card>
            <div class="flex items-center gap-4">
                <div class="p-3 bg-primary-50 rounded-full">
                    <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-medium text-secondary-900">Welcome back, {{ Auth::user()->name }}!</h2>
                    <p class="text-secondary-500">You are logged in and ready to build something amazing.</p>
                </div>
            </div>
        </x-ui.card>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <x-ui.card title="Profile Management">
                <p class="text-secondary-600 mb-4">Update your personal details and change your password.</p>
                <x-slot name="footer">
                    <x-ui.button tag="a" href="{{ route('profile') }}" variant="secondary" size="sm">Manage Profile</x-ui.button>
                </x-slot>
            </x-ui.card>

            <x-ui.card title="System Status">
                <div class="flex items-center gap-2">
                    <span class="flex h-3 w-3 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                    </span>
                    <span class="text-secondary-600 font-medium">Operational</span>
                </div>
                <p class="text-sm text-secondary-500 mt-2">All systems running smoothly.</p>
            </x-ui.card>

            <x-ui.card title="Quick Actions">
                <div class="space-y-2">
                    <x-ui.button class="w-full justify-center" variant="primary" size="sm">New Project</x-ui.button>
                    <x-ui.button class="w-full justify-center" variant="ghost" size="sm">View Documentation</x-ui.button>
                </div>
            </x-ui.card>
        </div>
    </div>
</x-app-layout>