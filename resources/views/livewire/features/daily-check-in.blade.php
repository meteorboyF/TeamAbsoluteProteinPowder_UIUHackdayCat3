<div class="bg-white rounded-lg shadow-sm border border-secondary-200 p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h3 class="text-lg font-bold text-secondary-900">Daily Check-In</h3>
            <p class="text-sm text-secondary-600">How are you feeling today?</p>
        </div>
        @if($currentStreak > 0)
            <div class="text-center">
                <div class="text-2xl font-bold text-orange-500">🔥 {{ $currentStreak }}</div>
                <div class="text-xs text-secondary-600">day streak</div>
            </div>
        @endif
    </div>

    @if(session()->has('message'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-4">
            {{ session('message') }}
        </div>
    @endif

    @if($hasCheckedInToday)
        <div class="text-center py-8">
            <div class="text-6xl mb-4">✅</div>
            <p class="text-secondary-700 font-medium">You've checked in today!</p>
            <p class="text-sm text-secondary-500 mt-2">Come back tomorrow to continue your streak</p>
        </div>
    @else
        <div class="grid grid-cols-3 gap-4">
            <button wire:click="checkIn('happy')"
                class="flex flex-col items-center justify-center p-6 rounded-lg border-2 border-secondary-200 hover:border-green-400 hover:bg-green-50 transition group">
                <div class="text-5xl mb-2 group-hover:scale-110 transition">😊</div>
                <span class="text-sm font-medium text-secondary-700">Happy</span>
            </button>

            <button wire:click="checkIn('neutral')"
                class="flex flex-col items-center justify-center p-6 rounded-lg border-2 border-secondary-200 hover:border-yellow-400 hover:bg-yellow-50 transition group">
                <div class="text-5xl mb-2 group-hover:scale-110 transition">😐</div>
                <span class="text-sm font-medium text-secondary-700">Neutral</span>
            </button>

            <button wire:click="checkIn('sad')"
                class="flex flex-col items-center justify-center p-6 rounded-lg border-2 border-secondary-200 hover:border-blue-400 hover:bg-blue-50 transition group">
                <div class="text-5xl mb-2 group-hover:scale-110 transition">😢</div>
                <span class="text-sm font-medium text-secondary-700">Sad</span>
            </button>
        </div>

        <p class="text-xs text-secondary-500 text-center mt-4">
            Check in daily to earn 50 XP and build your streak!
        </p>
    @endif
</div>