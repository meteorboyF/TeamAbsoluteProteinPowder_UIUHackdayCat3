<?php

namespace App\Livewire\Features;

use Livewire\Component;
use App\Services\Features\CommentService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Comments extends Component
{
    public $model; // The model instance
    public $newComment = '';
    public $replyingTo = null; // ID of the comment being replied to

    public $modelId;
    public $modelType;

    public function mount(Model $model)
    {
        $this->model = $model;
        $this->modelId = $model->id;
        $this->modelType = get_class($model);
    }

    public function replyTo($commentId)
    {
        $this->replyingTo = $commentId;
        $this->newComment = ''; // Clear previous input
    }

    public function cancelReply()
    {
        $this->replyingTo = null;
        $this->newComment = '';
    }

    public function postComment(CommentService $service)
    {
        $this->validate([
            'newComment' => 'required|string|max:1000',
        ]);

        $userId = auth()->id() ?? 'anon_user';

        $service->createComment(
            target: $this->model,
            content: $this->newComment,
            userId: $userId,
            parentId: $this->replyingTo // Pass parent ID
        );

        $this->newComment = '';
        $this->replyingTo = null; // Reset reply state
    }

    public function render(CommentService $service)
    {
        return view('livewire.features.comments', [
            'comments' => $service->getComments($this->model)
        ]);
    }
}
