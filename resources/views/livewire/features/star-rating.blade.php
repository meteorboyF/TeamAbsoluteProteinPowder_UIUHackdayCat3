<div class="p-4 bg-white border rounded-lg shadow-sm">
    <div class="flex items-center justify-between mb-4">
        <div>
            <div class="text-3xl font-bold text-gray-800">{{ $average }} <span
                    class="text-sm text-gray-500 font-normal">/ 5</span></div>
            <div class="text-xs text-gray-500">{{ $count }} reviews</div>
        </div>

        <!-- Star Display -->
        <div class="flex text-yellow-400">
            @for ($i = 1; $i <= 5; $i++)
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    fill="{{ $i <= round($average) ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="1.5"
                    class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                </svg>
            @endfor
        </div>
    </div>

    <!-- Rating Input Area -->
    <div class="border-t pt-4">
        <h4 class="text-sm font-bold text-gray-700 mb-2">{{ $userReview ? 'Your Review' : 'Leave a Review' }}</h4>

        <div class="flex gap-1 mb-2">
            @for ($i = 1; $i <= 5; $i++)
                <button wire:click="setRating({{ $i }})" class="focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-8 h-8 {{ $i <= $rating ? 'text-yellow-400' : 'text-gray-300' }} hover:scale-110 transition">
                        <path fill-rule="evenodd"
                            d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            @endfor
        </div>

        <div class=" mb-2">
            <textarea wire:model="comment"
                class="w-full border border-gray-300 rounded p-2 text-sm focus:ring-blue-500 focus:border-blue-500"
                placeholder="Share your thoughts..." rows="2"></textarea>
        </div>

        <button wire:click="submitReview"
            class="w-full bg-blue-600 text-white rounded py-2 text-sm font-semibold hover:bg-blue-700 transition">
            {{ $userReview ? 'Update Review' : 'Submit Review' }}
        </button>
    </div>
</div>