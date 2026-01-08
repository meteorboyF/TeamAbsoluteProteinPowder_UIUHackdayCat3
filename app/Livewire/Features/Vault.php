<?php

namespace App\Livewire\Features;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class Vault extends Component
{
    use WithFileUploads;

    public $items = []; 
    public $showUploadModal = false;
    
    // Upload Form Inputs
    public $newItemType = 'photo'; // photo, audio
    public $newItemFile;
    public $newItemNote;
    
    public $unlockType = 'date'; // date, level
    public $unlockDate;
    public $unlockLevel = 1;

    public $userLevel = 1;

    public function mount()
    {
        $this->userLevel = Auth::user() ? Auth::user()->level() : 1;
        $this->unlockDate = now()->addMonth()->format('Y-m-d');

        // Mock data setup with new Types and Unlock Conditions
        $this->items = [
            [
                'id' => 1,
                'type' => 'photo',
                'url' => 'https://images.unsplash.com/photo-1516589178581-6cd7833ae3b2?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'note' => 'Our first anniversary dinner.',
                'unlock_type' => 'date',
                'unlock_value' => '2023-11-15', // Past date
                'is_locked' => false,
            ],
            [
                'id' => 2,
                'type' => 'photo',
                'url' => 'https://images.unsplash.com/photo-1529333166437-7750a6dd5a70?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'note' => 'Christmas morning surprise.',
                'unlock_type' => 'date',
                'unlock_value' => '2026-12-25', // Future date
                'is_locked' => true,
            ],
            [
                'id' => 3,
                'type' => 'audio', // Voice Note
                'url' => '#', 
                'note' => 'A message for when we fight.',
                'unlock_type' => 'level',
                'unlock_value' => 3, // Requires Level 3
                'is_locked' => $this->userLevel < 3,
            ],
            [
                'id' => 4,
                'type' => 'photo', 
                'url' => 'https://images.unsplash.com/photo-1474552226712-ac0f0961a954?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'note' => 'The engagement ring...',
                'unlock_type' => 'level',
                'unlock_value' => 6, // Requires Level 6 (Soulmates)
                'is_locked' => $this->userLevel < 6,
            ],
        ];
    }

    public function save()
    {
        // Validation
        $this->validate([
            'newItemNote' => 'required|string|max:255',
            'unlockType' => 'required|in:date,level',
            'unlockDate' => 'required_if:unlockType,date|date',
            'unlockLevel' => 'required_if:unlockType,level|integer|min:1|max:6',
        ]);

        // Determine Locked Status
        $isLocked = true;
        $unlockValue = $this->unlockType === 'date' ? $this->unlockDate : $this->unlockLevel;

        if ($this->unlockType === 'date') {
            $isLocked = now()->lt($this->unlockDate);
        } else {
            $isLocked = $this->userLevel < $this->unlockLevel;
        }

        // Add New Item (Mock)
        $this->items[] = [
            'id' => count($this->items) + 1,
            'type' => $this->newItemType,
            'url' => $this->newItemType === 'photo' 
                ? 'https://images.unsplash.com/photo-1518020382113-a7e8fc38eac9?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80' 
                : '#',
            'note' => $this->newItemNote,
            'unlock_type' => $this->unlockType,
            'unlock_value' => $unlockValue,
            'is_locked' => $isLocked,
        ];

        $this->reset(['newItemFile', 'newItemNote', 'showUploadModal']);
        session()->flash('message', 'Memory sequestered in The Vault.');
    }

    public function render()
    {
        return view('livewire.features.vault')->layout('layouts.app');
    }
}
