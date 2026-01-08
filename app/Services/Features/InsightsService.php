<?php

namespace App\Services\Features;

use App\Models\Mood;
use App\Models\Status;
use App\Models\VaultItem;
use App\Models\XpLog;
use Carbon\Carbon;

class InsightsService
{
    /**
     * Generate relationship insights for a user
     */
    public function generateInsights(int $userId): array
    {
        return [
            'conflicts_resolved' => $this->getConflictsResolved($userId),
            'ghost_mode_count' => $this->getGhostModeCount($userId),
            'vault_items_count' => $this->getVaultItemsCount($userId),
            'mood_trend' => $this->getMoodTrend($userId),
            'xp_this_month' => $this->getXpThisMonth($userId),
            'relationship_health' => $this->getRelationshipHealth($userId),
            'suggestions' => $this->generateSuggestions($userId),
        ];
    }

    private function getConflictsResolved(int $userId): int
    {
        return XpLog::where('user_id', $userId)
            ->where('action', 'resolved_conflict')
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();
    }

    private function getGhostModeCount(int $userId): int
    {
        return Status::where('user_id', $userId)
            ->where('type', 'ghost')
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();
    }

    private function getVaultItemsCount(int $userId): int
    {
        return VaultItem::where('user_id', $userId)->count();
    }

    private function getMoodTrend(int $userId): string
    {
        $recentMoods = Mood::where('user_id', $userId)
            ->orderBy('date', 'desc')
            ->limit(7)
            ->pluck('mood')
            ->toArray();

        if (empty($recentMoods)) {
            return 'neutral';
        }

        $happyCount = count(array_filter($recentMoods, fn($m) => $m === 'happy'));
        $sadCount = count(array_filter($recentMoods, fn($m) => $m === 'sad'));

        if ($happyCount > $sadCount) {
            return 'positive';
        } elseif ($sadCount > $happyCount) {
            return 'negative';
        }

        return 'neutral';
    }

    private function getXpThisMonth(int $userId): int
    {
        return XpLog::where('user_id', $userId)
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('xp_amount');
    }

    private function getRelationshipHealth(int $userId): string
    {
        $gamification = app(GamificationService::class);
        $health = $gamification->getGardenHealth($userId);

        return $health['state'];
    }

    private function generateSuggestions(int $userId): array
    {
        $suggestions = [];

        // Check if user hasn't checked in recently
        $lastCheckIn = Mood::where('user_id', $userId)
            ->latest('date')
            ->first();

        if (!$lastCheckIn || $lastCheckIn->date->lt(Carbon::today())) {
            $suggestions[] = "Don't forget your daily check-in! Keep that streak going 🔥";
        }

        // Check ghost mode usage
        $ghostCount = $this->getGhostModeCount($userId);
        if ($ghostCount > 5) {
            $suggestions[] = "You've used Ghost Mode {$ghostCount} times this month. Maybe it's time for a heart-to-heart?";
        }

        // Check conflicts
        $conflicts = $this->getConflictsResolved($userId);
        if ($conflicts > 0) {
            $suggestions[] = "Amazing! You've resolved {$conflicts} conflicts this month. Communication is key! 💪";
        }

        // Check vault
        $vaultCount = $this->getVaultItemsCount($userId);
        if ($vaultCount === 0) {
            $suggestions[] = "Start building memories! Add your first photo to The Vault 📸";
        }

        return $suggestions;
    }
}
