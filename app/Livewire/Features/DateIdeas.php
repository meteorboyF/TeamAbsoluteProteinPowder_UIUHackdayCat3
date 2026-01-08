<?php

namespace App\Livewire\Features;

use Livewire\Component;
use App\Services\Core\GeminiService;

class DateIdeas extends Component
{
    public $vibe = 'Romantic'; // Default
    public $location = 'New York, NY'; // Default
    public $suggestion = null;
    public $places = [];
    public $isLoading = false;

    public function generateDate(GeminiService $gemini)
    {
        $this->isLoading = true;
        
        $prompt = "Create a perfect date plan for a couple who are feeling '{$this->vibe}' in '{$this->location}'. 
        
        Format the response in JSON with two keys:
        1. 'recommendation': A short paragraph describing the date flow.
        2. 'places': An array of 3-4 specific real places (restaurants, parks, activities) nearby with 'name', 'type', 'rating' (float), 'distance' (string), and 'emoji'.

        Do not include markdown. Just raw JSON.";

        try {
            $response = $gemini->generate($prompt);
            $jsonStr = str_replace(['```json', '```'], '', $response);
            $data = json_decode($jsonStr, true);
            
            $this->suggestion = $data['recommendation'] ?? "Enjoy a lovely time together!";
            $this->places = $data['places'] ?? [];
            
        } catch (\Exception $e) {
            $this->suggestion = "Could not generate ideas right now. Try again!";
            $this->places = [];
        }

        $this->isLoading = false;
    }

    public function render()
    {
        return view('livewire.features.date-ideas');
    }
}
