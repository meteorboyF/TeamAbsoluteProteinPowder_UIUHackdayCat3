<?php

namespace App\Livewire\Features;

use Livewire\Component;
use App\Models\Event;

class EventList extends Component
{
    public $events = [];

    public function mount()
    {
        $this->events = Event::where('start_at', '>=', now())
            ->orderBy('start_at', 'asc')
            ->take(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.features.event-list');
    }
}
