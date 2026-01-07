<?php

namespace App\Livewire\Support;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TicketIndex extends Component
{
    public function render()
    {
        $tickets = Ticket::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('livewire.support.ticket-index', [
            'tickets' => $tickets
        ]);
    }
}
