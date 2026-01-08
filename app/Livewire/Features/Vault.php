<?php

namespace App\Livewire\Features;

use Livewire\Component;
use Livewire\WithFileUploads;

class Vault extends Component
{
    use WithFileUploads;

    public $photos = []; // Mock data for now
    public $showUploadModal = false;
    public $newPhoto;
    public $date;
    public $note;

    public function mount()
    {
        // Mock data setup
        $this->photos = [
            [
                'id' => 1,
                'url' => 'https://images.unsplash.com/photo-1516589178581-6cd7833ae3b2?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'date' => '2023-11-15',
                'note' => 'Our first anniversary dinner.',
                'is_locked' => true,
            ],
            [
                'id' => 2,
                'url' => 'https://images.unsplash.com/photo-1529333166437-7750a6dd5a70?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'date' => '2023-12-25',
                'note' => 'Christmas morning surprise.',
                'is_locked' => true,
            ],
            [
                'id' => 3,
                'url' => 'https://images.unsplash.com/photo-1474552226712-ac0f0961a954?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'date' => '2024-01-01',
                'note' => 'New Year fireworks.',
                'is_locked' => true,
            ],
        ];
    }

    public function save()
    {
        // Validation would go here
        // $this->validate([...]);

        // Mock upload logic
        $this->photos[] = [
            'id' => count($this->photos) + 1,
            'url' => 'https://images.unsplash.com/photo-1518020382113-a7e8fc38eac9?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80', // Placeholder
            'date' => $this->date,
            'note' => $this->note,
            'is_locked' => true,
        ];

        $this->reset(['newPhoto', 'date', 'note', 'showUploadModal']);
    }

    public function render()
    {
        return view('livewire.features.vault')->layout('layouts.app');
    }
}
