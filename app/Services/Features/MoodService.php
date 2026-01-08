<?php

namespace App\Services\Features;

use App\Models\Mood;
use Carbon\Carbon;

class MoodService
{
    public function getMoodTimeline(int $userId, int $days = 30): array
    {
        $moods = Mood::where('user_id', $userId)
            ->where('date', '>=', Carbon::now()->subDays($days))
            ->orderBy('date', 'asc')
            ->get();

        $timeline = [];

        foreach ($moods as $mood) {
            $timeline[] = [
                'date' => $mood->date->format('M d'),
                'mood' => $mood->mood,
                'value' => $this->moodToValue($mood->mood),
            ];
        }

        return $timeline;
    }

    private function moodToValue(string $mood): int
    {
        return match ($mood) {
            'happy' => 3,
            'neutral' => 2,
            'sad' => 1,
            'withered' => 0, // handling potential edge case or future state
            default => 2,
        };
    }
}
