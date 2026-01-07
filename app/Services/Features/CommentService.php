<?php

namespace App\Services\Features;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use App\Services\Core\NotificationService;
use App\Models\User;

class CommentService
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Create a new comment for a given model.
     *
     * @param Model $target The model to attach the comment to.
     * @param string $content The comment text.
     * @param string|int $userId The ID of the user creating the comment.
     * @param string|null $parentId Optional ID of parent comment.
     * @return Comment
     */
    public function createComment(Model $target, string $content, string|int $userId, ?string $parentId = null): Comment
    {
        $comment = new Comment([
            'content' => $content,
            'user_id' => $userId,
            'parent_id' => $parentId,
        ]);

        $target->comments()->save($comment);

        // Notify parent author if this is a reply
        if ($parentId) {
            $parent = Comment::find($parentId);
            if ($parent && $parent->user_id != $userId) {
                $parentAuthor = User::find($parent->user_id);
                if ($parentAuthor) {
                    $this->notificationService->send(
                        $parentAuthor,
                        'New Reply',
                        'Someone replied to your comment: ' . substr($content, 0, 30) . '...',
                        null,
                        'info'
                    );
                }
            }
        }

        return $comment;
    }

    /**
     * Get comments for a given model (grouped by parent).
     *
     * @param Model $target
     * @return Collection
     */
    public function getComments(Model $target): Collection
    {
        return $target->comments()
            ->whereNull('parent_id') // Only top-level
            ->with('replies')        // Eager load replies
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
