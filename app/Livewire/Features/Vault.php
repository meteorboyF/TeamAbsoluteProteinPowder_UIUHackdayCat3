<?php

namespace App\Livewire\Features;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\VaultItem;

class Vault extends Component
{
    use WithFileUploads;

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

        // Create Vault Item
        VaultItem::create([
            'user_id' => Auth::id(),
            'type' => $this->newItemType,
            'file_path' => $this->newItemType === 'photo' 
                ? 'https://images.unsplash.com/photo-1518020382113-a7e8fc38eac9?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80' 
                : '#audio-placeholder',
            'note' => $this->newItemNote,
            'unlock_at' => $this->unlockType === 'date' ? $this->unlockDate : null,
            'unlock_level' => $this->unlockType === 'level' ? $this->unlockLevel : null,
            'is_hidden' => true,
        ]);

        $this->reset(['newItemFile', 'newItemNote', 'showUploadModal']);
        session()->flash('message', 'Memory sequestered in The Vault.');
    }

    public function render()
    {
        $items = VaultItem::where('user_id', Auth::id())->latest()->get();
        
        return view('livewire.features.vault', [
            'items' => $items,
        ])->layout('layouts.app');
    }
}
