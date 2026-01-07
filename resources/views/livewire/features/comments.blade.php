<div wire:poll.2s class="p-4 bg-white shadow rounded-lg">
    <h3 class="text-lg font-bold mb-4">Comments</h3>

    <!-- Main Input Area (only if not replying) -->
    @if(!$replyingTo)
        <div class="mb-4">
            <form wire:submit.prevent="postComment">
                <textarea wire:model="newComment"
                    class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Write a comment..." rows="2"></textarea>
                @error('newComment') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <div class="mt-2 text-right">
                    <button type="submit"
                        class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">Post</button>
                </div>
            </form>
        </div>
    @endif

    <!-- Comments List -->
    <div class="space-y-4">
        @forelse($comments as $comment)
            <!-- Top Level Comment -->
            <div class="border-b border-gray-100 pb-2 last:border-0 relative">
                <div class="flex justify-between text-xs text-gray-500 mb-1">
                    <span class="font-semibold text-blue-600">User: {{ $comment->user_id }}</span>
                    <span>{{ $comment->created_at->diffForHumans() }}</span>
                </div>
                <div class="text-gray-800 mb-2">
                    {{ $comment->content }}
                </div>

                <!-- Reply Button -->
                <button wire:click="replyTo('{{ $comment->id }}')" class="text-xs text-gray-400 hover:text-blue-500">
                    Reply
                </button>

                <!-- Reply Input (Inline) -->
                @if($replyingTo === $comment->id)
                    <div class="mt-2 ml-4 p-2 bg-gray-50 rounded border border-blue-100">
                        <form wire:submit.prevent="postComment">
                            <input wire:model="newComment" type="text"
                                class="w-full p-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-500"
                                placeholder="Write a reply..." autofocus>
                            <div class="mt-2 flex justify-end gap-2">
                                <button type="button" wire:click="cancelReply"
                                    class="text-xs text-gray-500 hover:underline">Cancel</button>
                                <button type="submit" class="px-2 py-1 bg-blue-600 text-white rounded text-xs">Reply</button>
                            </div>
                        </form>
                    </div>
                @endif

                <!-- Nested Replies -->
                @if($comment->replies->count() > 0)
                    <div class="ml-6 mt-2 space-y-2 border-l-2 border-gray-100 pl-3">
                        @foreach($comment->replies as $reply)
                            <div>
                                <div class="flex justify-between text-[10px] text-gray-400">
                                    <span class="font-semibold">User: {{ $reply->user_id }}</span>
                                    <span>{{ $reply->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="text-sm text-gray-700">
                                    {{ $reply->content }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @empty
            <div class="text-gray-400 text-center italic">No comments yet.</div>
        @endforelse
    </div>
</div>