<?php

namespace App\Livewire\Features;

use Livewire\Component;
use App\Services\Features\CommentService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Comments extends Component
{
    public $model; // The model instance (e.g., Post, User)
    public $newComment = '';

    // We can pass model_id and model_type if strict typing with Model is tricky in mount
    public $modelId;
    public $modelType;

    public function mount(Model $model)
    {
        $this->model = $model;
        $this->modelId = $model->id;
        $this->modelType = get_class($model);
    }

    public function postComment(CommentService $service)
    {
        $this->validate([
            'newComment' => 'required|string|max:1000',
        ]);

        // Simulating a user ID for now as we might not have Auth fully set up by Fardeen yet
        // In production: auth()->id()
        $userId = auth()->id() ?? 'anon_user';

        $service->createComment($this->model, $this->newComment, $userId);

        $this->newComment = '';
    }

    public function render(CommentService $service)
    {
        return view('livewire.features.comments', [
            'comments' => $service->getComments($this->model)
        ]);
    }
}
