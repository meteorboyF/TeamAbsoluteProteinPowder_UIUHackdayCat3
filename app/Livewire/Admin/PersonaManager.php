<?php

namespace App\Livewire\Admin;

use App\Models\BotPersona;
use Livewire\Component;

class PersonaManager extends Component
{
    public $name, $slug, $system_prompt, $greeting_message;
    public $personas;

    protected $rules = [
        'name' => 'required',
        'slug' => 'required|unique:bot_personas,slug',
        'system_prompt' => 'required',
        'greeting_message' => 'required',
    ];

    public function mount()
    {
        $this->refreshPersonas();
    }

    public function refreshPersonas()
    {
        $this->personas = BotPersona::all();
    }

    public function create()
    {
        $this->validate();

        // Deactivate others if this one is set to active (logic simplified for now)
        // For this hackathon, let's just create it inactive
        BotPersona::create([
            'name' => $this->name,
            'slug' => $this->slug,
            'system_prompt' => $this->system_prompt,
            'greeting_message' => $this->greeting_message,
            'is_active' => false,
        ]);

        $this->reset(['name', 'slug', 'system_prompt', 'greeting_message']);
        $this->refreshPersonas();
    }

    public function activate($id)
    {
        BotPersona::query()->update(['is_active' => false]);
        BotPersona::where('id', $id)->update(['is_active' => true]);
        $this->refreshPersonas();
    }

    public function render()
    {
        return view('livewire.admin.persona-manager')->layout('layouts.app');
    }
}
