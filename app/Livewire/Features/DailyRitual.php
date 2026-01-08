<?php

namespace App\Livewire\Features;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class DailyRitual extends Component
{
    public $user;
    public $partner;
    public $currentMood = null;
    public $partnerMood = null;

    public $moods = [
        'mood_red' => [
            'color' => 'bg-red-500', 
            'label' => 'Intense / Passionate',
            'energy' => 'High',
            'desc' => 'Your heart is beating fast. You are full of fire.'
        ],
        'mood_blue' => [
            'color' => 'bg-blue-500', 
            'label' => 'Calm / Melancholy',
            'energy' => 'Low',
            'desc' => 'Your heart needs quiet. You are flowing like water.'
        ],
        'mood_green' => [
            'color' => 'bg-emerald-500', 
            'label' => 'Peaceful / Balanced',
            'energy' => 'Balanced',
            'desc' => 'Your heart is steady. You are grounded like earth.'
        ],
        'mood_yellow' => [
            'color' => 'bg-yellow-400', 
            'label' => 'Joyful / Anxious',
            'energy' => 'High',
            'desc' => 'Your heart is bright. You are glowing like the sun.'
        ],
    ];

    public function mount()
    {
        $this->user = Auth::user();
        if ($this->user->partner_id) {
            $this->partner = $this->user->partner;
        }

        // Load today's mood
        $todayStatus = $this->user->statuses()
            ->where('type', 'like', 'mood_%')
            ->whereDate('created_at', today())
            ->latest()
            ->first();

        if ($todayStatus) {
            $this->currentMood = $todayStatus->type;
        }

        // Load partner's mood
        if ($this->partner) {
            $partnerStatus = $this->partner->statuses()
                ->where('type', 'like', 'mood_%')
                ->whereDate('created_at', today())
                ->latest()
                ->first();

            if ($partnerStatus) {
                $this->partnerMood = $partnerStatus->type;
            }
        }
    }

    public function selectMood($moodKey)
    {
        // Save mood as a Status
        Status::create([
            'user_id' => $this->user->id,
            'type' => $moodKey,
            'is_active' => true,
            'expires_at' => now()->endOfDay(),
        ]);

        $this->currentMood = $moodKey;
        
        // Award XP for simple check-in
        // Mocking Service call: $this->user->addXp(20);
    }

    public function getAlignmentProperty()
    {
        if (!$this->currentMood || !$this->partnerMood) return null;

        // Simple alignment logic
        if ($this->currentMood === $this->partnerMood) {
            return [
                'title' => 'Perfect Resonance',
                'desc' => 'You are on the same wavelength. Great time to connect deeply.',
                'color' => 'text-purple-400',
            ];
        }

        $myEnergy = $this->moods[$this->currentMood]['energy'];
        $partnerEnergy = $this->moods[$this->partnerMood]['energy'];

        if ($myEnergy === $partnerEnergy) {
            return [
                'title' => 'Energy Match',
                'desc' => "Different feelings, but same intensity. You'll understand each other well.",
                'color' => 'text-green-400',
            ];
        }

        return [
            'title' => 'Complementary Forces',
            'desc' => 'Opposite energies can balance each other. Approach with curiosity.',
            'color' => 'text-blue-400',
        ];
    }

    public function render()
    {
        return view('livewire.features.daily-ritual');
    }
}
