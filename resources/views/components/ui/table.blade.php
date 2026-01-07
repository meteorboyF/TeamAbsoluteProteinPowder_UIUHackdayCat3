@props([
    'headers' => [],
])

<div class="flow-root">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                <table class="min-w-full divide-y divide-secondary-300">
                    <thead class="bg-secondary-50">
                        <tr>
                            @foreach($headers as $header)
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-secondary-900 sm:pl-6">{{ $header }}</th>
                            @endforeach
                            <!-- Extra slot for actions if needed, controlled by parent usually, but we can keep it open -->
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-secondary-200 bg-white">
                        {{ $slot }}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
