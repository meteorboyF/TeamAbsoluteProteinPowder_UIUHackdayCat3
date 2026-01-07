<?php

namespace App\Livewire\Features;

use Livewire\Component;
use App\Models\Log;
use Illuminate\Database\Eloquent\Model;

class ActivityFeed extends Component
{
    public $subject; // Optional: Filter by specific subject (e.g. Project)
    public $limit = 10;

    public function mount(Model $subject = null)
    {
        $this->subject = $subject;
    }

    public function loadMore()
    {
        $this->limit += 10;
    }

    public function render()
    {
        $query = Log::query()->with('user')->latest();

        if ($this->subject) {
            $query->where('subject_id', $this->subject->id)
                ->where('subject_type', get_class($this->subject));
        }

        return view('livewire.features.activity-feed', [
            'logs' => $query->take($this->limit)->get()
        ]);
    }
}
