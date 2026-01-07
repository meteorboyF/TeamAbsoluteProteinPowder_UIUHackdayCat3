<?php

namespace App\Livewire\Features;

use Livewire\Component;
use App\Services\Features\ChatService;
use Illuminate\Database\Eloquent\Model;

class Chat extends Component
{
    public $model; // The channel (Project, Ticket, etc.)
    public $newMessage = '';

    public $modelId;
    public $modelType;

    public function mount(Model $model)
    {
        $this->model = $model;
        $this->modelId = $model->id;
        $this->modelType = get_class($model);
    }

    public function sendMessage(ChatService $service)
    {
        $this->validate([
            'newMessage' => 'required|string|max:2000',
        ]);

        $userId = auth()->id() ?? 'anon_user';

        $service->sendMessage($this->model, $this->newMessage, $userId);

        $this->newMessage = '';

        $this->dispatch('notify', type: 'success', message: 'Message sent!');
    }

    public function render(ChatService $service)
    {
        return view('livewire.features.chat', [
            'messages' => $service->getMessages($this->model)
        ]);
    }
}
