<?php

namespace App\Livewire\Features;

use Livewire\Component;
use App\Services\Core\GeminiService;

class GiftSuggestions extends Component
{
    public $partnerType = '';
    public $hobbies = '';
    public $suggestions = [];
    public $isLoading = false;

    public function generateIdeas(GeminiService $gemini)
    {
        $this->isLoading = true;
        
        $prompt = "Suggest 3 unique, creative, and personalized gift ideas for a partner who can be described as '{$this->partnerType}' and loves '{$this->hobbies}'. 
        Format the response as a JSON array where each object has 'title', 'description', and a 'match_score' (percentage). 
        Do not include markdown code blocks, just the raw JSON.";

        try {
            $response = $gemini->generate($prompt);
            // Clean up potentially messy JSON response
            $jsonStr = str_replace(['```json', '```'], '', $response);
            $this->suggestions = json_decode($jsonStr, true) ?? [];
        } catch (\Exception $e) {
            $this->suggestions = [];
        }

        $this->isLoading = false;
    }

    public function render()
    {
        return view('livewire.features.gift-suggestions');
    }
}
