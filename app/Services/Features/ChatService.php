<?php

namespace App\Services\Features;

use App\Models\Message;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use App\Services\Core\NotificationService;
use App\Models\User;

class ChatService
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

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

        // Notify other members
        if (isset($channel->member_ids) && is_array($channel->member_ids)) {
            foreach ($channel->member_ids as $memberId) {
                if ($memberId != $userId) {
                    $user = User::find($memberId);
                    if ($user) {
                        $this->notificationService->send(
                            $user,
                            'New Message in ' . ($channel->name ?? 'Chat'),
                            substr($body, 0, 50) . '...',
                            route('dashboard'), // Todo: Deep link to chat
                            'info'
                        );
                    }
                }
            }
        }

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
