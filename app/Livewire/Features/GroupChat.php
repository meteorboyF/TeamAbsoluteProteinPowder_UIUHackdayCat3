<?php

namespace App\Livewire\Features;

use Livewire\Component;
use App\Models\Channel;
use App\Services\Features\ChatService;

class GroupChat extends Component
{
    public $channelId;
    public $newMessage = '';
    public $isCreating = false;
    public $newChannelName = '';

    public function mount($channelId = null)
    {
        $this->channelId = $channelId;
    }

    public function createChannel()
    {
        $this->validate(['newChannelName' => 'required|string|min:3']);

        $channel = Channel::create([
            'name' => $this->newChannelName,
            'type' => 'public',
            'member_ids' => [auth()->id() ?? 'anon_user'],
        ]);

        $this->channelId = $channel->id;
        $this->isCreating = false;
        $this->newChannelName = '';
    }

    public function sendMessage(ChatService $service)
    {
        $this->validate([
            'newMessage' => 'required|string|max:2000',
        ]);

        $channel = Channel::find($this->channelId);
        if (!$channel)
            return;

        $userId = auth()->id() ?? 'anon_user';
        $service->sendMessage($channel, $this->newMessage, $userId);

        $this->newMessage = '';
    }

    public function render(ChatService $service)
    {
        $channel = $this->channelId ? Channel::find($this->channelId) : null;
        $messages = $channel ? $service->getMessages($channel) : [];
        $allChannels = Channel::all();

        return view('livewire.features.group-chat', [
            'currentChannel' => $channel,
            'messages' => $messages,
            'channels' => $allChannels
        ]);
    }
}
