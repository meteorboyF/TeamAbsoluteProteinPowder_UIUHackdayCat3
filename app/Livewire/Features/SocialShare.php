<?php

namespace App\Livewire\Features;

use Livewire\Component;

class SocialShare extends Component
{
    public $url;
    public $title;
    public $showCopied = false;

    public function mount($url = null, $title = 'Check this out!')
    {
        $this->url = $url ?? url()->current();
        $this->title = $title;
    }

    public function copyToClipboard()
    {
        $this->showCopied = true;
    }

    public function render()
    {
        return view('livewire.features.social-share');
    }
}
