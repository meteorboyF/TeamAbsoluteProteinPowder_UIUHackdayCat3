<?php

namespace App\Livewire\Features;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class Garden extends Component
{
    public $user;
    public $partner;
    public $inputCode;
    public $partnerCode;
    
    // Gamification
    public $currentLevel = 1;
    public $currentXp = 0;
    public $nextLevelXp = 100;
    
    public function mount()
    {
        $this->user = Auth::user();
        
        // Ensure user has a linking code
        if (!$this->user->partner_code) {
            $this->user->partner_code = strtoupper(Str::random(6));
            $this->user->save();
        }
        $this->partnerCode = $this->user->partner_code;

        // Load partner if exists
        if ($this->user->partner_id) {
            $this->partner = User::find($this->user->partner_id);
        }

        // Load XP/Level (Mock/Simple implementation for now)
        $this->currentXp = $this->user->xp ?? 0;
        $this->calculateLevel();
    }

    public function calculateLevel()
    {
        // Simple linear progression: Level = (XP / 100) + 1
        $this->currentLevel = floor($this->currentXp / 100) + 1;
        $this->nextLevelXp = $this->currentLevel * 100;
        
        // Cap at level 6 (Soulmates)
        if ($this->currentLevel > 6) {
            $this->currentLevel = 6;
        }
    }

    public function waterGarden()
    {
        // Add Daily Check-in XP
        $this->user->xp = ($this->user->xp ?? 0) + 50;
        $this->user->save();
        
        $this->currentXp = $this->user->xp;
        $this->calculateLevel();
        
        // Notify user (standard session flash)
        session()->flash('message', 'You watered the garden! +50 XP');
    }

    public function linkPartner()
    {
        $this->validate([
            'inputCode' => 'required|string|size:6|different:partnerCode',
        ]);

        $potentialPartner = User::where('partner_code', strtoupper($this->inputCode))->first();

        if (!$potentialPartner) {
            $this->addError('inputCode', 'Invalid partner code.');
            return;
        }

        if ($potentialPartner->partner_id) {
            $this->addError('inputCode', 'This user is already linked.');
            return;
        }

        // Link both users
        $this->user->partner_id = $potentialPartner->id;
        $this->user->save();

        $potentialPartner->partner_id = $this->user->id;
        $potentialPartner->save();

        $this->partner = $potentialPartner;
        
        session()->flash('message', 'Partner linked successfully! You are now connected.');
    }

    public function getLevelTitleProperty()
    {
        return match($this->currentLevel) {
            1 => 'Strangers',
            2 => 'Acquaintances',
            3 => 'Friends',
            4 => 'Close Friends',
            5 => 'Partners',
            6 => 'Soulmates',
            default => 'Wanderers',
        };
    }

    public function render()
    {
        return view('livewire.features.garden');
    }
}
