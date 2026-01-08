<?php

namespace App\Livewire\Features;

use Livewire\Component;
use Illuminate\Database\Eloquent\Model;
use App\Models\Like;

class LikeButton extends Component
{
    public $model;
    public $modelId;
    public $modelType;
    public $isLiked = false;
    public $count = 0;

    public function mount(Model $model)
    {
        $this->model = $model;
        $this->modelId = $model->id;
        $this->modelType = get_class($model);

        $this->refreshState();
    }

    public function refreshState()
    {
        $this->count = Like::where('likeable_id', $this->modelId)
            ->where('likeable_type', $this->modelType)
            ->count();

        $userId = auth()->id();
        if ($userId) {
            $this->isLiked = Like::where('likeable_id', $this->modelId)
                ->where('likeable_type', $this->modelType)
                ->where('user_id', $userId)
                ->exists();
        }
    }

    public function toggleLike()
    {
        $userId = auth()->id() ?? 'anon_user'; // For hackathon demo

        if ($this->isLiked) {
            Like::where('likeable_id', $this->modelId)
                ->where('likeable_type', $this->modelType)
                ->where('user_id', $userId)
                ->delete();
        } else {
            Like::create([
                'user_id' => $userId,
                'likeable_id' => $this->modelId,
                'likeable_type' => $this->modelType,
            ]);
        }

        $this->refreshState();
    }

    public function render()
    {
        return view('livewire.features.like-button');
    }
}
