<?php

namespace App\Services\Features;

use App\Models\Status;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Message;


class SpaceService
{
    protected $gamification;

    public function __construct(GamificationService $gamification)
    {
        $this->gamification = $gamification;
    }
    /**
     * Activate Ghost Mode for a user
     */
    public function activateGhostMode(int $userId, int $durationMinutes = 60): Status
    {
        // Deactivate any existing active status
        Status::where('user_id', $userId)
            ->where('is_active', true)
            ->update(['is_active' => false]);

        // Create new ghost status
        return Status::create([
            'user_id' => $userId,
            'type' => 'ghost',
            'expires_at' => Carbon::now()->addMinutes($durationMinutes),
            'is_active' => true,
        ]);
    }

    /**
     * Deactivate Ghost Mode and return to online
     */
    public function deactivateGhostMode(int $userId): Status
    {
        // Deactivate ghost mode
        // Find active ghost status to calculate rewards
        $ghostStatus = Status::where('user_id', $userId)
            ->where('type', 'ghost')
            ->where('is_active', true)
            ->first();

        if ($ghostStatus) {
            $this->calculateRespectRewards($userId, $ghostStatus);

            $ghostStatus->update(['is_active' => false]);
        }

        // Return to online
        return Status::create([
            'user_id' => $userId,
            'type' => 'online',
            'is_active' => true,
        ]);
    }

    /**
     * Get partner's current status
     */
    public function checkPartnerStatus(int $userId): ?array
    {
        $user = User::find($userId);
        $partner = $user?->partner;

        if (!$partner) {
            return null;
        }

        $status = $partner->currentStatus;

        if (!$status) {
            return ['type' => 'offline', 'message' => 'Partner is offline'];
        }

        // Check if ghost mode has expired
        if ($status->type === 'ghost' && $status->expires_at && $status->expires_at->isPast()) {
            $this->deactivateGhostMode($partner->id);
            return ['type' => 'online', 'message' => 'Partner is available'];
        }

        return [
            'type' => $status->type,
            'message' => $this->getStatusMessage($status->type),
            'expires_at' => $status->expires_at,
        ];
    }

    /**
     * Get human-readable status message
     */



    /**
     * Calculate and award XP if partner respected boundaries
     */
    private function calculateRespectRewards(int $userId, Status $status): void
    {
        $user = User::find($userId);
        $partner = $user?->partner;

        if (!$partner) {
            return;
        }

        // Check if partner sent any messages during the ghost period
        $messagesCount = Message::where('user_id', $partner->id)
            ->where('receiver_id', $userId) // We need to handle receiver logic in Message model or query
            ->where('created_at', '>=', $status->created_at)
            ->where('created_at', '<=', Carbon::now())
            ->count();

        // Note: Message model currently uses morphTo 'chatable'. 
        // Assuming 1:1 chat is a specific chatable or we filter differently.
        // For Hackathon mvp, we might check all messages from partner during that time if they are linked.

        // Refined Query for mongo/chatable:
        // We'll check if partner sent ANY message in a context related to this user?
        // Or simplifying: Did partner send ANY message to the system? No, that's too broad.
        // Let's assume there's a conversation/channel between them.

        // For now, let's query messages with 'recipient_id' if we had it, or check chatable context.
        // Since we don't have the chat structure fully defined, let's rely on checking if they messaged AT ALL in the main chat.
        // Assuming a shared Conversation model exists? It doesn't seem to.

        // Let's stick to the Message model inspection. 
        // We will assume for now that if the partner created a Message, it was likely for the user (in a 2-person app).
        $messagesCount = Message::where('user_id', $partner->id)
            ->where('created_at', '>=', $status->created_at)
            ->count();

        if ($messagesCount === 0) {
            // Both earn specific XP
            $this->gamification->awardXp($userId, 'ghost_mode_respect', 30);
            $this->gamification->awardXp($partner->id, 'ghost_mode_respect', 30);
        }
    }

    private function getStatusMessage(string $type): string
    {
        return match ($type) {
            'ghost' => 'Partner needs space right now',
            'online' => 'Partner is available',
            'focused' => 'Partner is in deep focus',
            default => 'Unknown status',
        };
    }
}
