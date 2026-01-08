<?php

namespace App\Services\Features;

use Illuminate\Support\Facades\Http;
use App\Models\User;

class AuraService
{
    protected $moodService;

    public function __construct(MoodService $moodService)
    {
        $this->moodService = $moodService;
    }
    /**
     * Calculate Aura Alignment Score
     */
    public function getAuraAlignment(int $userId): array
    {
        $user = User::find($userId);
        $partner = $user?->partner;

        if (!$partner) {
            return ['alignment' => 0, 'message' => 'No partner linked'];
        }

        // Get today's mood
        $userMoodData = $this->moodService->getMoodTimeline($userId, 1);
        $partnerMoodData = $this->moodService->getMoodTimeline($partner->id, 1);

        $userMood = $userMoodData[0]['mood'] ?? null;
        $partnerMood = $partnerMoodData[0]['mood'] ?? null;

        if (!$userMood || !$partnerMood) {
            return ['alignment' => 0, 'message' => 'One of you hasn\'t checked in today.'];
        }

        if ($userMood === $partnerMood) {
            return ['alignment' => 100, 'message' => 'Your auras are perfectly aligned today! Perfect time for a date.'];
        }

        // Check compatibility (simple map)
        $compatible = [
            'happy' => ['excited', 'content'],
            'sad' => ['neutral', 'calm'],
            'neutral' => ['calm', 'happy'],
        ];

        if (in_array($partnerMood, $compatible[$userMood] ?? [])) {
            return ['alignment' => 75, 'message' => 'Your energies are complementary. Good time to talk.'];
        }

        return ['alignment' => 40, 'message' => 'Your moods are quite different. Approach with empathy.'];
    }

    /**
     * Analyze the conflict conversation and return AI-powered advice.
     *
     * @param array $messages
     * @return string
     */
    public function analyzeConflict(array $messages): string
    {
        // If no API key, fall back to mock
        if (!config('services.gemini.api_key')) {
            return $this->getMockAdvice();
        }

        try {
            $conversation = $this->formatConversation($messages);

            $response = Http::timeout(10)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                ])
                ->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=' . config('services.gemini.api_key'), [
                    'contents' => [
                        [
                            'parts' => [
                                [
                                    'text' => $this->buildPrompt($conversation)
                                ]
                            ]
                        ]
                    ],
                    'generationConfig' => [
                        'temperature' => 0.7,
                        'maxOutputTokens' => 200,
                    ]
                ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['candidates'][0]['content']['parts'][0]['text'] ?? $this->getMockAdvice();
            }

            return $this->getMockAdvice();

        } catch (\Exception $e) {
            \Log::error('Aura AI Error: ' . $e->getMessage());
            return $this->getMockAdvice();
        }
    }

    /**
     * Format messages for AI analysis
     */
    private function formatConversation(array $messages): string
    {
        $formatted = [];
        foreach ($messages as $msg) {
            $formatted[] = "{$msg['sender']}: {$msg['content']}";
        }
        return implode("\n", $formatted);
    }

    /**
     * Build the AI prompt for conflict mediation
     */
    private function buildPrompt(string $conversation): string
    {
        return <<<PROMPT
You are Aura, an AI relationship mediator. Analyze this conflict conversation and provide ONE brief, empathetic suggestion (max 2 sentences) to help de-escalate and improve communication.

Conversation:
{$conversation}

Focus on:
- Using "I" statements instead of "you" accusations
- Acknowledging feelings
- Finding common ground
- De-escalation techniques

Your advice (2 sentences max):
PROMPT;
    }

    /**
     * Fallback mock advice when AI is unavailable
     */
    private function getMockAdvice(): string
    {
        $advice = [
            "It seems like things are getting heated. Try using 'I feel...' statements instead of 'You always...' to express your emotions.",
            "I notice strong emotions here. Take a deep breath and try to understand your partner's perspective before responding.",
            "Communication is key. Focus on the issue at hand rather than bringing up past conflicts.",
            "Remember, you're on the same team. Try to find common ground and work together toward a solution.",
        ];

        return $advice[array_rand($advice)];
    }
}
