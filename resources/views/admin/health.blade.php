<x-layouts.app>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold mb-6">System Health</h2>

            <div class="grid grid-cols-2 gap-4">
                <div class="p-6 bg-white rounded-lg shadow">
                    <h3 class="font-bold text-gray-700">Database (MongoDB)</h3>
                    <p
                        class="text-xl {{ str_contains($mongoStatus, 'Connected') ? 'text-green-600' : 'text-red-600' }}">
                        {{ $mongoStatus }}
                    </p>
                </div>

                <div class="p-6 bg-white rounded-lg shadow">
                    <h3 class="font-bold text-gray-700">Cache</h3>
                    <p class="text-xl text-blue-600">
                        {{ $cacheStatus }}
                    </p>
                </div>

                <div class="p-6 bg-white rounded-lg shadow">
                    <h3 class="font-bold text-gray-700">Environment</h3>
                    <p class="text-lg">
                        {{ app()->environment() }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>