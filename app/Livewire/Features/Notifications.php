<?php

namespace App\Livewire\Features;

use Livewire\Component;
use App\Models\Log;

class Notifications extends Component
{
    public $unreadCount = 0;

    // Checks every 5 seconds
    public function mount()
    {
        $this->updateCount();
    }

    public function updateCount()
    {
        // simplistic definition of "notification" for Hackathon:
        // Any log not created by me, in the last hour (mock logic)
        // Real implementation would have 'read_at' on a pivot table.
        $userId = auth()->id();
        if (!$userId)
            return;

        $this->unreadCount = Log::where('user_id', '!=', $userId)
            ->where('created_at', '>', now()->subHour())
            ->count();
    }

    public function render()
    {
        return view('livewire.features.notifications');
    }
}
