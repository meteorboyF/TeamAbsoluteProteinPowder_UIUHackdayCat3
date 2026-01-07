<x-layouts.app>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
                    <p class="mb-4">You're logged in as <strong>{{ Auth::user()->name }}</strong>!</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{ route('profile') }}"
                            class="block p-6 bg-blue-50 hover:bg-blue-100 rounded-lg border border-blue-200 transition">
                            <h2 class="font-bold text-blue-700">Manage Profile</h2>
                            <p class="text-sm text-blue-600">Update your details and password.</p>
                        </a>
                        <!-- Add more dashboard widgets here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>