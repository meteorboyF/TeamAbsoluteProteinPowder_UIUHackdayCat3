<?php

namespace App\Livewire\Features;

use Livewire\Component;
use App\Models\Announcement;

class AnnouncementBanner extends Component
{
    public $announcement;
    public $isVisible = true;

    public function mount()
    {
        // Fetch latest active announcement
        $this->announcement = Announcement::where('is_active', true)
            ->latest()
            ->first();
    }

    public function dismiss()
    {
        $this->isVisible = false;
        // In real app, store dismissal in session or user preferences
        // session()->put('dismissed_announcement_' . $this->announcement->id, true);
    }

    public function render()
    {
        return view('livewire.features.announcement-banner');
    }
}
