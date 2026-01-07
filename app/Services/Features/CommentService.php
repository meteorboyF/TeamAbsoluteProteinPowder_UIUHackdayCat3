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
     * @return Comment
     */
    public function createComment(Model $target, string $content, string|int $userId): Comment
    {
        $comment = new Comment([
            'content' => $content,
            'user_id' => $userId,
        ]);

        $target->comments()->save($comment);

        return $comment;
    }

    /**
     * Get comments for a given model.
     *
     * @param Model $target
     * @return Collection
     */
    public function getComments(Model $target): Collection
    {
        return $target->comments()->orderBy('created_at', 'desc')->get();
    }
}
