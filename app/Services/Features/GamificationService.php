<?php

namespace App\Services\Features;

use App\Models\User;
use App\Models\XpLog;

class GamificationService
{
    // XP thresholds for levels
    private const LEVELS = [
        1 => 0,      // Strangers
        2 => 100,    // Acquaintances
        3 => 300,    // Friends
        4 => 600,    // Close Friends
        5 => 1000,   // Partners
        6 => 1500,   // Soulmates
    ];

    /**
     * Award XP to a user for an action
     */
    public function awardXp(int $userId, string $action, int $amount): XpLog
    {
        return XpLog::create([
            'user_id' => $userId,
            'action' => $action,
            'xp_amount' => $amount,
        ]);
    }

    /**
     * Get user's total XP
     */
    public function getTotalXp(int $userId): int
    {
        return XpLog::where('user_id', $userId)->sum('xp_amount');
    }

    /**
     * Calculate user's current level
     */
    public function getUserLevel(int $userId): int
    {
        $totalXp = $this->getTotalXp($userId);

        $level = 1;
        foreach (self::LEVELS as $lvl => $requiredXp) {
            if ($totalXp >= $requiredXp) {
                $level = $lvl;
            } else {
                break;
            }
        }

        return $level;
    }

    /**
     * Get garden health state based on XP
     */
    public function getGardenHealth(int $userId): array
    {
        $level = $this->getUserLevel($userId);
        $totalXp = $this->getTotalXp($userId);

        // Determine visual state
        $state = match (true) {
            $level >= 6 => 'blooming',
            $level >= 4 => 'healthy',
            $level >= 2 => 'growing',
            default => 'withered',
        };

        return [
            'level' => $level,
            'total_xp' => $totalXp,
            'state' => $state,
            'level_name' => $this->getLevelName($level),
            'next_level_xp' => $this->getNextLevelXp($level),
        ];
    }

    /**
     * Get human-readable level name
     */
    private function getLevelName(int $level): string
    {
        return match ($level) {
            1 => 'Strangers',
            2 => 'Acquaintances',
            3 => 'Friends',
            4 => 'Close Friends',
            5 => 'Partners',
            6 => 'Soulmates',
            default => 'Unknown',
        };
    }

    /**
     * Get XP needed for next level
     */
    private function getNextLevelXp(int $currentLevel): ?int
    {
        return self::LEVELS[$currentLevel + 1] ?? null;
    }

    /**
     * Common XP awards
     */
    public const XP_ACTIONS = [
        'daily_check_in' => 50,
        'resolved_conflict' => 100,
        'vault_upload' => 25,
        'ghost_mode_respect' => 30,
        'week_streak' => 200,
    ];
}
