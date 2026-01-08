<?php

namespace App\Livewire\Features;

use Livewire\Component;
use App\Services\Features\AuraService;

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

    public function sendMessage(AuraService $auraService)
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
    }

    public function unlockChat()
    {
        // In the real implementation, this would unlock the chat for the OTHER user.
        // For now, since we are building the core mechanic "button", we will just simulate the action.
        // Perhaps we can dispatch an event or flash a message.
        session()->flash('message', 'You have offered empathy. The other user can now speak.');

        // Note: In a real-time app, this would use broadcasting to unlock the other client.
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
