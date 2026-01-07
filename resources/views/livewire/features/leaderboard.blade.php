<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="bg-gradient-to-r from-yellow-500 to-orange-500 p-4 text-white flex justify-between items-center">
        <h3 class="font-bold text-lg flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path fill-rule="evenodd"
                    d="M5.143 14.25l.001-.002c.038-.028.426-.328 1.32-.281.896.046 2.059.6 4.391 3.535.808 1.018 2.262 1.157 3.239.31l1.632-1.416a2.25 2.25 0 00.7-1.472V5.25A2.25 2.25 0 0014.175 3H5.25a2.25 2.25 0 00-2.25 2.25v16.126a2.25 2.25 0 002.143 2.249.75.75 0 00.75-.75v-8.625z"
                    clip-rule="evenodd" />
            </svg>
            Leaderboard
        </h3>
        <select wire:model.live="period"
            class="bg-white/20 border-none text-sm rounded text-white cursor-pointer focus:ring-0">
            <option value="all" class="text-black">All Time</option>
            <option value="weekly" class="text-black">This Week</option>
        </select>
    </div>

    <div class="divide-y divide-gray-100">
        @foreach($topUsers as $index => $user)
            <div class="p-4 flex items-center gap-4 hover:bg-gray-50 transition">
                <div class="font-bold text-gray-400 w-6 text-center text-xl {{ $index < 3 ? 'text-yellow-500' : '' }}">
                    #{{ $index + 1 }}
                </div>

                <div
                    class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-lg font-bold text-gray-500">
                    {{ substr($user->name, 0, 1) }}
                </div>

                <div class="flex-1">
                    <div class="font-bold text-gray-800">{{ $user->name }}</div>
                    <div class="text-xs text-gray-500">{{ $user->email }}</div>
                </div>

                <div class="text-right">
                    <div class="font-bold text-blue-600">{{ $user->reputation ?? rand(100, 5000) }} pts</div>
                    <!-- Mock random if 0 -->
                </div>
            </div>
        @endforeach
    </div>
</div>