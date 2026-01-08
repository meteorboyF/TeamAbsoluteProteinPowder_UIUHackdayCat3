<?php

namespace App\Services\Features;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CommentService
{
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
