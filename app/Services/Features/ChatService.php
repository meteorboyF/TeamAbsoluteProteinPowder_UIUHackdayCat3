<?php

namespace App\Services\Features;

use App\Models\Message;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ChatService
{
    /**
     * Send a new message to a channel.
     *
     * @param Model $channel The model to attach the message to.
     * @param string $body The message content.
     * @param string|int $userId The ID of the user sending the message.
     * @return Message
     */
    public function sendMessage(Model $channel, string $body, string|int $userId): Message
    {
        $message = new Message([
            'body' => $body,
            'user_id' => $userId,
        ]);

        $channel->messages()->save($message);

        return $message;
    }

    /**
     * Get recent messages for a channel.
     *
     * @param Model $channel
     * @param int $limit
     * @return Collection
     */
    public function getMessages(Model $channel, int $limit = 50): Collection
    {
        return $channel->messages()
            ->orderBy('created_at', 'asc') // Oldest first for chat history
            ->limit($limit)
            ->get();
    }
}
