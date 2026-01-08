<?php

namespace App\Livewire\Features;

use Livewire\Component;
use App\Services\Core\GeminiService;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

#[Layout('layouts.app')]
class AiCupid extends Component
{
    public $user;
    public $partner;
    public $partnerMood = null;
    public $relationshipLevel = 1;

    public $currentTab = 'gifts'; // 'gifts' or 'dates'
    public $isAnalyzing = true;

    public $giftSuggestions = [];
    public $dateSuggestions = [];

    public function mount()
    {
        $this->user = Auth::user();
        
        if ($this->user->partner_id) {
            $this->partner = $this->user->partner;
            $this->relationshipLevel = $this->user->level();
            
            // Get Partner's Mood
             $status = $this->partner->statuses()
                ->where('type', 'like', 'mood_%')
                ->whereDate('created_at', today())
                ->latest()
                ->first();
            
            if ($status) {
                $this->partnerMood = $status->type;
            }
        }
    }

    public function analyze(GeminiService $gemini)
    {
        $this->generateGiftIdeas($gemini);
        $this->generateDateIdeas($gemini);
        
        $this->isAnalyzing = false;
    }

    public function generateGiftIdeas(GeminiService $gemini)
    {
        $mood = $this->partnerMood ? str_replace('mood_', '', $this->partnerMood) : 'unknown';
        
        $prompt = "Suggest 3 unique gift ideas for a partner whose current mood is '{$mood}'. 
        Format as JSON array with keys: 'title', 'desc' (short description), 'icon' (single emoji). 
        Raw JSON only.";

        try {
            $response = $gemini->generate($prompt);
            $jsonStr = str_replace(['```json', '```'], '', $response);
            $this->giftSuggestions = json_decode($jsonStr, true) ?? [];
        } catch (\Exception $e) {
            $this->giftSuggestions = [
                ['title' => 'Mystery Box', 'desc' => 'A surprise to brighten their day.', 'icon' => '🎁'],
                ['title' => 'Open When... Letters', 'desc' => 'Handwritten notes for future moments.', 'icon' => '✉️'],
            ];
        }
    }

    public function generateDateIdeas(GeminiService $gemini)
    {
        $level = $this->relationshipLevel;
        $context = $level > 5 ? "long-term soulmates" : "dating phase";

        $prompt = "Suggest 2 date ideas for a couple who are in the {$context} (Relationship Level {$level}). 
        Format as JSON array with keys: 'title', 'desc', 'time' (duration). 
        Raw JSON only.";

        try {
            $response = $gemini->generate($prompt);
            $jsonStr = str_replace(['```json', '```'], '', $response);
            $this->dateSuggestions = json_decode($jsonStr, true) ?? [];
        } catch (\Exception $e) {
             $this->dateSuggestions = [
                ['title' => 'Coffee & Bookstore', 'desc' => 'Low pressure, high conversation.', 'time' => '2 hrs'],
                ['title' => 'Arcade Night', 'desc' => 'Playful competition to break the ice.', 'time' => '3 hrs'],
            ];
        }
    }

    public function render()
    {
        return view('livewire.features.ai-cupid');
    }
}
