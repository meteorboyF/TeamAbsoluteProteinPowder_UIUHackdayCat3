<?php

namespace App\Services\Features;

use App\Models\User;
use Illuminate\Support\Facades\Http;

class AiCupidService
{
    protected $gamification;
    protected $moodService;

    public function __construct(GamificationService $gamification, MoodService $moodService)
    {
        $this->gamification = $gamification;
        $this->moodService = $moodService;
    }

    /**
     * Get Smart Gift Suggestions based on partner's mood and level
     */
    public function getGiftSuggestions(int $userId): array
    {
        $user = User::find($userId);
        $partner = $user?->partner;

        if (!$partner) {
            return ['error' => 'No partner linked.'];
        }

        // Get partner's recent mood context
        $timeline = $this->moodService->getMoodTimeline($partner->id, 7);
        $recentMoods = array_map(fn($t) => $t['mood'], $timeline);
        $moodContext = implode(', ', array_unique($recentMoods));

        // Get Relationship Level
        $levelName = $this->gamification->getGardenHealth($partner->id)['level_name'];

        $prompt = "Suggest 3 unique, thoughtful gift ideas for my partner.
                   Role: AI Cupid.
                   Context: We are at the '{$levelName}' stage of our relationship.
                   Partner's recent moods: {$moodContext}.
                   Focus on emotional resonance and meaningful gestures over expensive items.";

        return $this->callGemini($prompt, 'gifts');
    }

    /**
     * Get Date Night Ideas based on relationship level
     */
    public function getDateIdeas(int $userId): array
    {
        $user = User::find($userId);
        $partner = $user?->partner;

        if (!$partner) {
            return ['error' => 'No partner linked.'];
        }

        $level = $this->gamification->getUserLevel($userId);
        $levelName = $this->gamification->getGardenHealth($userId)['level_name'];

        $prompt = "Suggest 3 creative date night ideas.
                   Role: AI Cupid.
                   Relationship Stage: {$levelName} (Level {$level}).
                   Goal: Deepen connection and create memories.
                   Vibe: Romantic, unique, and engaging.";

        return $this->callGemini($prompt, 'dates');
    }

    private function callGemini(string $prompt, string $keyName): array
    {
        if (!config('services.gemini.api_key')) {
            return [
                $keyName => [
                    "Mock Suggestion 1: A handwritten letter.",
                    "Mock Suggestion 2: A surprise picnic.",
                    "Mock Suggestion 3: A custom playlist."
                ]
            ];
        }

        try {
            $response = Http::timeout(10)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=' . config('services.gemini.api_key'), [
                    'contents' => [['parts' => [['text' => $prompt]]]],
                    'generationConfig' => ['temperature' => 0.7]
                ]);

            if ($response->successful()) {
                $text = $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? '';
                // Simple parsing assuming list format or just return text
                return [$keyName => explode("\n", $text)]; // Naive parsing check
            }
        } catch (\Exception $e) {
            \Log::error('AI Cupid Error: ' . $e->getMessage());
        }

        return [$keyName => ["(AI Unavailable) Plan a simple movie night."]];
    }
}
