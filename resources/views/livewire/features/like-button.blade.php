<div class="flex items-center gap-1">
    <button wire:click="toggleLike"
        class="flex items-center gap-1 focus:outline-none transition transform active:scale-95 p-1 rounded hover:bg-gray-100">
        @if($isLiked)
            <!-- Filled Heart -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                class="w-6 h-6 text-red-500 animate-[bounce_0.3s_ease-in-out]">
                <path
                    d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.691 2.25 5.353 4.681 3.25 8.04 3.25c2.408 0 4.197 1.282 5.093 3.19.897-1.908 2.686-3.19 5.094-3.19 3.359 0 5.79 2.103 5.79 5.441 0 3.483-2.439 6.669-4.743 8.818a25.18 25.18 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
            </svg>
        @else
            <!-- Outline Heart -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-6 h-6 text-gray-500 hover:text-red-500 transition">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
            </svg>
        @endif
    </button>
    <span class="text-sm font-medium {{ $isLiked ? 'text-red-500' : 'text-gray-500' }}">
        {{ $count }}
    </span>
</div>