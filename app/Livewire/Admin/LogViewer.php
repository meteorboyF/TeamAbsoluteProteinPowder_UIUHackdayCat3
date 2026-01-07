<?php

namespace App\Livewire\Admin;

use App\Models\Log;
use Livewire\Component;
use Livewire\WithPagination;

class LogViewer extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.admin.log-viewer', [
            'logs' => Log::with('causer', 'subject')->latest()->paginate(20),
        ]);
    }
}
