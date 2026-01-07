<?php

namespace App\Livewire\Admin;

use App\Models\Faq;
use Livewire\Component;

class FaqManager extends Component
{
    public $question, $answer, $category;
    public $faqs;

    public function mount()
    {
        $this->refreshFaqs();
    }

    public function refreshFaqs()
    {
        $this->faqs = Faq::where('is_active', true)->orderBy('sort_order')->get();
    }

    public function create()
    {
        $this->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        Faq::create([
            'question' => $this->question,
            'answer' => $this->answer,
            'category' => $this->category ?? 'General',
            'is_active' => true,
            'sort_order' => 0,
        ]);

        $this->reset(['question', 'answer']);
        $this->refreshFaqs();
    }

    public function render()
    {
        return view('livewire.admin.faq-manager')->layout('layouts.app');
    }
}
