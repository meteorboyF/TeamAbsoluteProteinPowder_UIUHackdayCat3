<?php

namespace App\Services\Features;

use App\Models\Message;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class ChatService
{
    private const SLOW_MODE_DURATION = 120; // 2 minutes in seconds
    /**
     * Send a new message to a channel.
     *
     * @param Model $channel The model to attach the message to.
     * @param string $body The message content.
     * @param string|int $userId The ID of the user sending the message.
     * @return Message
     */
    public function sendMessage(Model $channel, string $body, string|int $userId, ?string $emotion = null): Message
    {
        // Check Slow Mode
        if ($this->isSlowModeActive($channel) && !$this->canUserSendMessage($channel, $userId)) {
            throw new \Exception('Slow mode is active. Please wait before messaging.');
        }

        // Check Empathy Mode (if partner locked reply capability)
        if ($this->isEmpathyModeActive($channel) && !$this->isUserAllowedToTalk($channel, $userId)) {
            throw new \Exception('Partner has requested you to listen first.');
        }

        $message = new Message([
            'body' => $body,
            'user_id' => $userId,
            'emotion' => $emotion,
        ]);

        $channel->messages()->save($message);

        // Update last message timestamp for slow mode logic
        Cache::put("chat_last_message_{$channel->id}_{$userId}", Carbon::now(), self::SLOW_MODE_DURATION);

        return $message;
    }

    /**
     * Check if Slow Mode verification checks out
     */
    private function canUserSendMessage(Model $channel, string|int $userId): bool
    {
        $lastMessageTime = Cache::get("chat_last_message_{$channel->id}_{$userId}");

        if ($lastMessageTime && Carbon::now()->diffInSeconds($lastMessageTime) < self::SLOW_MODE_DURATION) {
            return false;
        }

        return true;
    }

    private function isSlowModeActive(Model $channel): bool
    {
        // Logic to determine if slow mode is enforced for this chat/channel
        // Could be stored in channel metadata or global setting for conflict mode
        return $channel->metadata['slow_mode_active'] ?? false;
    }

    /**
     * Empathy Button Logic
     */
    public function toggleEmpathyMode(Model $channel, int $activeUserId, bool $enable): void
    {
        // When enabled, only the activeUserId can talk? Or they force the other to listen?
        // "Unlock the other person's ability to reply" -> So initially locked?
        // Let's assume enabling empathy mode means "I am listening, you can talk" OR "I am talking, please listen".
        // Requirement: "Button to 'Unlock' the other person's ability to reply immediately, promoting listening over speaking."
        // This implies the default state in Conflict Mode might be restrictively turn-based or locked.

        // Let's implement it as: If active, the OTHER person is muted until UNLOCKED.

        $metadata = $channel->metadata ?? [];
        $metadata['empathy_mode_active'] = $enable;
        if ($enable) {
            $metadata['talking_user_id'] = $activeUserId; // The one who pressed it? Or the one allowed?
            // "Unlock the other person's ability to reply" implies the user presses it to let PARTNER reply.
            $metadata['allowed_user_id'] = null; // Open floor?
        }

        // Let's go with: Conflict Mode = Slow Mode by default.
        // Empathy Button = Bypasses Slow Mode for the other person?
        // "Unlock ability to reply immediately"

        // Simpler interpretation:
        // By default in Conflict Mode, maybe you can't reply until partner finishes?
        // Let's stick to the prompt: "Unlock the other person's ability to reply immediately"
        // Implies a lock exists.

        // We will store state in metadata.
        // For Hackathon, we'll implement the toggle.

        $metadata['empathy_unlocked_for_partner'] = $enable;
        $channel->metadata = $metadata;
        $channel->save();
    }

    private function isEmpathyModeActive(Model $channel): bool
    {
        return $channel->metadata['conflict_mode_active'] ?? false;
    }

    private function isUserAllowedToTalk(Model $channel, string|int $userId): bool
    {
        // If conflict mode is active, check if it's this user's turn or if they are unlocked
        // Implementation detail: Simple "Token" passing?

        // For now, let's assume if conflict mode is active, we check specific flags.
        // If just Slow Mode, the `canUserSendMessage` handles it.

        return true; // Placeholder for strict turn-taking if needed.
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
