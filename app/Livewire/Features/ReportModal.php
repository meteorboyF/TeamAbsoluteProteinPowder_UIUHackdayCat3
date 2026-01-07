<?php

namespace App\Livewire\Features;

use Livewire\Component;
use Illuminate\Database\Eloquent\Model;
use App\Models\Report;

class ReportModal extends Component
{
    public $model;
    public $isOpen = false;
    public $reason = 'spam';
    public $description = '';

    public function mount(Model $model)
    {
        $this->model = $model;
    }

    public function open()
    {
        $this->isOpen = true;
    }

    public function close()
    {
        $this->isOpen = false;
        $this->reset(['reason', 'description']);
    }

    public function submitReport()
    {
        $this->validate([
            'reason' => 'required',
            'description' => 'required|min:5'
        ]);

        Report::create([
            'reporter_id' => auth()->id() ?? 1,
            'reportable_id' => $this->model->id,
            'reportable_type' => get_class($this->model),
            'reason' => $this->reason,
            'description' => $this->description,
            'status' => 'pending'
        ]);

        $this->close();
        // Emitting generic event for toast notification (assumed exists or generic JS)
        $this->dispatch('reported');
    }

    public function render()
    {
        return view('livewire.features.report-modal');
    }
}
