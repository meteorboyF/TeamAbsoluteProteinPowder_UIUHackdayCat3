<?php

namespace App\Livewire;

use App\Models\BotPersona;
use App\Models\ChatMessage;
use App\Services\Core\ChatBotService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Livewire\Component;

class ChatWidget extends Component
{
    public $isOpen = false;
    public $input = '';
    public $sessionId;
    public $messages = [];
    public $persona;

    public function mount()
    {
        $this->sessionId = Session::getId();
        $this->refreshState();
    }

    public function refreshState()
    {
        $this->persona = BotPersona::getActive();
        if ($this->persona) {
            $this->messages = ChatMessage::where('session_id', $this->sessionId)
                ->latest()
                ->take(50)
                ->get()
                ->reverse()
                ->values();
        }
    }

    public function toggle()
    {
        $this->isOpen = !$this->isOpen;
        // If opening for first time and no messages, trigger greeting? 
        // Logic simplified: The view handles empty state.
    }

    public function sendMessage()
    {
        if (trim($this->input) === '')
            return;

        $service = new ChatBotService();
        $service->respond($this->sessionId, $this->input);

        $this->input = '';
        $this->refreshState();
    }

    public function render()
    {
        return view('livewire.chat-widget');
    }
}
