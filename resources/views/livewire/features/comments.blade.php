<div wire:poll.2s class="p-4 bg-white shadow rounded-lg">
    <h3 class="text-lg font-bold mb-4">Comments</h3>

    <!-- Input Area -->
    <div class="mb-4">
        <form wire:submit.prevent="postComment">
            <textarea wire:model="newComment"
                class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Write a comment..." rows="3"></textarea>
            @error('newComment') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            <div class="mt-2 text-right">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition"
                    wire:loading.attr="disabled">
                    Post Comment
                </button>
            </div>
        </form>
    </div>

    <!-- Comments List -->
    <div class="space-y-4">
        @forelse($comments as $comment)
            <div class="border-b border-gray-100 pb-2 last:border-0">
                <div class="flex justify-between text-xs text-gray-500 mb-1">
                    <span class="font-semibold">User: {{ $comment->user_id }}</span>
                    <span>{{ $comment->created_at->diffForHumans() }}</span>
                </div>
                <div class="text-gray-800">
                    {{ $comment->content }}
                </div>
            </div>
        @empty
            <div class="text-gray-400 text-center italic">
                No comments yet. Be the first!
            </div>
        @endforelse
    </div>
</div>