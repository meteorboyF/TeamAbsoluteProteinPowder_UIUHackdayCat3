<?php

namespace App\Livewire\Features;

use Livewire\Component;
use App\Services\Features\AuraService;
use App\Services\Features\GamificationService;
use App\Events\ChatUnlocked;

class ConflictChat extends Component
{
    public $messages = [];
    public $newMessage = '';
    public $isLocked = false;
    public $health = 50;
    public $auraAdvice = '';

    public function mount()
    {
        // Initial state
    }

    public function sendMessage(AuraService $auraService, GamificationService $gamification)
    {
        if ($this->isLocked || empty(trim($this->newMessage))) {
            return;
        }

        // Add message
        $this->messages[] = [
            'content' => $this->newMessage,
            'sender' => 'me',
            'created_at' => now()->diffForHumans(),
        ];

        // Health Logic
        $this->updateHealth($this->newMessage);

        // Lock the input
        $this->isLocked = true;

        // Aura Analysis (simulated AI trigger)
        // In a real app, this might be async or queued
        $this->auraAdvice = $auraService->analyzeConflict($this->messages);

        // Clear input
        $this->newMessage = '';

        // Check if conflict is resolved (health at 100%)
        if ($this->health >= 100) {
            $gamification->awardXp(
                auth()->id(),
                'resolved_conflict',
                100
            );

            session()->flash('message', '🎉 Conflict resolved! +100 XP');
        }
    }

    public function unlockChat()
    {
        // Broadcast to unlock the OTHER user
        // Assuming user has a 'partner_id' attribute or relationship
        // Fallback to ID+1 or similar for demo if partner_id is missing, but adhering to USER REQUEST:
        $partnerId = auth()->user()->partner_id ?? null;

        if ($partnerId) {
            broadcast(new ChatUnlocked($partnerId));
        }

        // Award XP for resolving conflict
        $gamification = app(GamificationService::class);
        $gamification->awardXp(auth()->id(), 'resolved_conflict', 100);

        session()->flash('message', 'You have offered empathy. The other user can now speak.');
        // We do NOT unlock ourselves here necessarily, as the instruction implies we unlock the OTHER user.
        // But usually, if I offer empathy, I might wait for them.
        // The user request said: "The input field must disable after the user sends 1 message."
        // And "Empathy Button: A button that unlocks the chat for the other user."

        // However, usually in turn based, offering empathy might not unlock ME.
        // But for testing/demo, we leave the flash message.
    }

    protected function updateHealth($message)
    {
        $message = strtolower($message);
        // Simple regex check as requested
        if (preg_match('/(hate|stupid|idiot|worst)/', $message)) {
            $this->health = max(0, $this->health - 10);
        } elseif (preg_match('/(feel|love|sorry|understand)/', $message)) {
            $this->health = min(100, $this->health + 10);
        }
    }

    public function render()
    {
        return view('livewire.features.conflict-chat');
    }
}
