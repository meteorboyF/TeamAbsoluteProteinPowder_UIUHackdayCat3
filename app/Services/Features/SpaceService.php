<?php

namespace App\Services\Features;

use App\Models\Status;
use App\Models\User;
use Carbon\Carbon;

class SpaceService
{
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
        Status::where('user_id', $userId)
            ->where('type', 'ghost')
            ->where('is_active', true)
            ->update(['is_active' => false]);

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
