<?php

namespace App\Livewire\Features;

use Livewire\Component;
use App\Models\User;
use App\Models\Channel;
use Illuminate\Support\Facades\Route;

class GlobalSearch extends Component
{
    public $query = '';
    public $results = [];
    public $isOpen = false;

    // Listen for Cmd+K / Ctrl+K
    protected $listeners = ['toggleSearch' => 'toggle'];

    public function updatedQuery()
    {
        if (strlen($this->query) < 2) {
            $this->results = [];
            return;
        }

        // Generic search implementation - tailored for Hackathon demo
        $users = User::where('name', 'like', "%{$this->query}%")->take(3)->get()->map(function ($u) {
            return ['type' => 'User', 'title' => $u->name, 'id' => $u->id, 'icon' => 'user'];
        });

        $channels = Channel::where('name', 'like', "%{$this->query}%")->take(3)->get()->map(function ($c) {
            return ['type' => 'Channel', 'title' => '#' . $c->name, 'id' => $c->id, 'icon' => 'hashtag'];
        });

        $this->results = $users->merge($channels);
    }

    public function open()
    {
        $this->isOpen = true;
    }

    public function close()
    {
        $this->isOpen = false;
        $this->query = '';
        $this->results = [];
    }

    public function render()
    {
        return view('livewire.features.global-search');
    }
}
