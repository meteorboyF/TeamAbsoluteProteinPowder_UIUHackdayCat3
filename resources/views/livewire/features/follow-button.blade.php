<div class="flex flex-col items-center">
    <button wire:click="toggleFollow" class="px-4 py-1 rounded-full text-sm font-bold border transition
        {{ $isFollowing
    ? 'bg-white text-gray-800 border-gray-300 hover:border-red-300 hover:text-red-500 hover:bg-red-50'
    : 'bg-blue-600 text-white border-transparent hover:bg-blue-700' 
        }}">
        {{ $isFollowing ? 'Following' : 'Follow' }}
    </button>
    <span class="text-xs text-gray-500 mt-1">{{ $count }} followers</span>
</div>