<?php

namespace App\Livewire\Features;

use Livewire\Component;
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

    public function analyze()
    {
        // Simulate AI "Thinking" delay
        sleep(1); 
        
        $this->generateGiftIdeas();
        $this->generateDateIdeas();
        
        $this->isAnalyzing = false;
    }

    public function generateGiftIdeas()
    {
        // Logic: Suggest gifts based on Partner's Mood
        if (!$this->partnerMood) {
            $this->giftSuggestions = [
                ['title' => 'Mystery Box', 'desc' => 'A surprise to brighten their day.', 'icon' => '🎁'],
                ['title' => 'Open When... Letters', 'desc' => 'Handwritten notes for future moments.', 'icon' => '✉️'],
            ];
            return;
        }

        switch ($this->partnerMood) {
            case 'mood_blue': // Sad/Calm
                $this->giftSuggestions = [
                    ['title' => 'Comfort Care Package', 'desc' => 'Soft blanket, scented candle, and hot cocoa.', 'icon' => '🧸'],
                    ['title' => 'Weighted Hoodie', 'desc' => 'Like a warm hug they can wear.', 'icon' => '🧥'],
                    ['title' => 'Custom Playlist', 'desc' => 'Songs that say "I am here for you".', 'icon' => '🎵'],
                ];
                break;
            case 'mood_red': // Intense/Passionate
                $this->giftSuggestions = [
                    ['title' => 'Adventure Date Box', 'desc' => 'Tools for a spontaneous road trip.', 'icon' => '🗺️'],
                    ['title' => 'Bold Fragrance', 'desc' => 'Something intense and memorable.', 'icon' => '🧴'],
                ];
                break;
            case 'mood_green': // Balanced
                $this->giftSuggestions = [
                    ['title' => 'Indoor Plant', 'desc' => 'Something to grow together.', 'icon' => '🪴'],
                    ['title' => 'Journal Set', 'desc' => 'For shared thoughts and calm reflection.', 'icon' => '📓'],
                ];
                break;
            default: // Yellow or others
                $this->giftSuggestions = [
                    ['title' => 'DIY Craft Kit', 'desc' => 'Create something fun together.', 'icon' => '🎨'],
                    ['title' => 'Gourmet Snacks', 'desc' => 'Delicious treats to share.', 'icon' => '🍪'],
                ];
        }
    }

    public function generateDateIdeas()
    {
        // Logic: Suggest dates based on Relationship Level
        $level = $this->relationshipLevel;

        if ($level <= 2) { // Early stages
            $this->dateSuggestions = [
                ['title' => 'Coffee & Bookstore', 'desc' => 'Low pressure, high conversation.', 'time' => '2 hrs'],
                ['title' => 'Arcade Night', 'desc' => 'Playful competition to break the ice.', 'time' => '3 hrs'],
            ];
        } elseif ($level <= 4) { // Serious
            $this->dateSuggestions = [
                ['title' => 'Cooking Class', 'desc' => 'Learn a new skill as a team.', 'time' => '4 hrs'],
                ['title' => 'Hiking Trail', 'desc' => 'Nature walk with deep talks.', 'time' => 'Half Day'],
            ];
        } else { // Soulmates
            $this->dateSuggestions = [
                ['title' => 'Weekend Cabin Trip', 'desc' => 'Total disconnection together.', 'time' => 'Weekend'],
                ['title' => 'Memory Lane Tour', 'desc' => 'Revisit the spot you first met.', 'time' => 'Evening'],
            ];
        }
    }

    public function render()
    {
        return view('livewire.features.ai-cupid');
    }
}
