<?php

namespace App\Livewire\Features;

use App\Services\Features\MoodService;
use Livewire\Component;

class MoodTimeline extends Component
{
    public function render(MoodService $moodService)
    {
        $timeline = $moodService->getMoodTimeline(auth()->id());

        return view('livewire.features.mood-timeline', [
            'timeline' => $timeline
        ]);
    }
}
