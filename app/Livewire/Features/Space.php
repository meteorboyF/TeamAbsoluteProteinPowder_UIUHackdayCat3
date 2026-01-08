<?php

namespace App\Livewire\Features;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Space extends Component
{
    public $isActive = false;
    public $endTime = null;
    public $duration = 45; // Default minutes
    public $xpEarned = 0;

    public function mount()
    {
        // Check if there's an active session in cache/DB for this user
        // (Mocking persistence for now)
        if (session()->has('ghost_mode_end')) {
            $end = session('ghost_mode_end');
            if (now()->lt($end)) {
                $this->isActive = true;
                $this->endTime = $end->timestamp;
            } else {
                session()->forget('ghost_mode_end');
            }
        }
    }

    public function activate($minutes)
    {
        $this->duration = $minutes;
        $this->endTime = now()->addMinutes($minutes);
        $this->isActive = true;
        
        session(['ghost_mode_end' => $this->endTime]);
    }

    public function deactivate()
    {
        $this->isActive = false;
        $this->endTime = null;
        $this->xpEarned += 10; // Reward for respecting boundaries/using feature
        
        session()->forget('ghost_mode_end');
    }

    public function render()
    {
        return view('livewire.features.space');
    }
}
