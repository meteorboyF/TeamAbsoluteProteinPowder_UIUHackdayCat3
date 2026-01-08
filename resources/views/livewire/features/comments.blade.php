<div wire:poll.3s class="p-4 bg-white shadow rounded-lg border border-secondary-200">
    <div class="space-y-6">
        <h3 class="font-bold text-lg text-secondary-800">Comments ({{ $comments->count() }})</h3>

        <!-- Main Comment Form -->
        <div class="bg-secondary-50 p-4 rounded-lg flex gap-3">
            <div
                class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 font-bold shrink-0">
                {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
            </div>
            <div class="flex-1 space-y-2">
                <x-ui.textarea placeholder="Write a comment..." wire:model="newComment" rows="2" />
                <div class="flex justify-end">
                    <x-ui.button wire:click="postComment" variant="primary" size="sm">
                        Post Comment
                    </x-ui.button>
                </div>
            </div>
        </div>

        <!-- Comments List -->
        <div class="space-y-6">
            @foreach($comments as $comment)
                <!-- Parent Comment -->
                <div class="flex gap-3 group">
                    <div
                        class="w-8 h-8 rounded-full bg-secondary-200 flex items-center justify-center text-secondary-600 font-bold shrink-0">
                        {{ substr($comment->user->name ?? 'A', 0, 1) }}
                    </div>
                    <div class="flex-1">
                        <div class="bg-white p-3 rounded-lg shadow-sm border border-secondary-200">
                            <div class="flex justify-between items-start mb-1">
                                <span
                                    class="font-bold text-sm text-secondary-900">{{ $comment->user->name ?? 'Anonymous' }}</span>
                                <span class="text-xs text-secondary-400">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-sm text-secondary-700">{{ $comment->body ?? $comment->content }}</p>
                        </div>

                        <div class="flex items-center gap-4 mt-1 ml-1">
                            <button wire:click="replyTo('{{ $comment->id }}')"
                                class="text-xs font-medium text-secondary-500 hover:text-primary-600">
                                Reply
                            </button>
                        </div>

                        <!-- Inline Reply Form -->
                        @if($replyingTo === $comment->id)
                            <div class="mt-3 flex gap-3 ml-2">
                                <div class="flex-1 space-y-2">
                                    <!-- REUSED newComment property since we're in reply mode -->
                                    <x-ui.textarea placeholder="Write a reply..." wire:model="newComment" rows="1" autofocus />
                                    <div class="flex justify-end gap-2">
                                        <x-ui.button wire:click="cancelReply" variant="ghost" size="xs">
                                            Cancel
                                        </x-ui.button>
                                        <!-- Calls postComment which handles reply logic based on replyingTo state -->
                                        <x-ui.button wire:click="postComment" variant="primary" size="xs">
                                            Reply
                                        </x-ui.button>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Nested Replies -->
                        @if($comment->replies->count() > 0)
                            <div class="mt-3 space-y-3 pl-4 border-l-2 border-secondary-100 ml-4">
                                @foreach($comment->replies as $reply)
                                    <div class="flex gap-3">
                                        <div
                                            class="w-6 h-6 rounded-full bg-secondary-100 flex items-center justify-center text-secondary-500 text-xs font-bold shrink-0">
                                            {{ substr($reply->user->name ?? 'A', 0, 1) }}
                                        </div>
                                        <div class="flex-1">
                                            <div class="bg-secondary-50 p-2 rounded-lg">
                                                <div class="flex justify-between items-start mb-1">
                                                    <span
                                                        class="font-bold text-xs text-secondary-900">{{ $reply->user->name ?? 'Anonymous' }}</span>
                                                    <span
                                                        class="text-[10px] text-secondary-400">{{ $reply->created_at->diffForHumans() }}</span>
                                                </div>
                                                <p class="text-sm text-secondary-700">{{ $reply->body ?? $reply->content }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>