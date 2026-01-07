<?php

namespace App\Livewire\Support;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TicketCreate extends Component
{
    public $subject;
    public $message;
    public $priority = 'medium';

    protected $rules = [
        'subject' => 'required|min:5',
        'message' => 'required|min:10',
        'priority' => 'required|in:low,medium,high',
    ];

    public function store()
    {
        $this->validate();

        $ticket = Ticket::create([
            'user_id' => Auth::id(),
            'subject' => $this->subject,
            'status' => 'open',
            'priority' => $this->priority,
        ]);

        $ticket->messages()->create([
            'user_id' => Auth::id(),
            'message' => $this->message,
        ]);

        return redirect()->route('tickets.index');
    }

    public function render()
    {
        return view('livewire.support.ticket-create');
    }
}
