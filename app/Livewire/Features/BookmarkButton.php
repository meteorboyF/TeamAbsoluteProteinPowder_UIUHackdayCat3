<?php

namespace App\Livewire\Features;

use Livewire\Component;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bookmark;

class BookmarkButton extends Component
{
    public $model;
    public $isBookmarked = false;

    public function mount(Model $model)
    {
        $this->model = $model;
        $this->refreshState();
    }

    public function refreshState()
    {
        $userId = auth()->id();
        if ($userId) {
            $this->isBookmarked = Bookmark::where('bookmarkable_id', $this->model->id)
                ->where('bookmarkable_type', get_class($this->model))
                ->where('user_id', $userId)
                ->exists();
        }
    }

    public function toggleBookmark()
    {
        $userId = auth()->id() ?? 'anon_user';

        if ($this->isBookmarked) {
            Bookmark::where('bookmarkable_id', $this->model->id)
                ->where('bookmarkable_type', get_class($this->model))
                ->where('user_id', $userId)
                ->delete();
        } else {
            Bookmark::create([
                'user_id' => $userId,
                'bookmarkable_id' => $this->model->id,
                'bookmarkable_type' => get_class($this->model),
            ]);
        }

        $this->refreshState();
    }

    public function render()
    {
        return view('livewire.features.bookmark-button');
    }
}
