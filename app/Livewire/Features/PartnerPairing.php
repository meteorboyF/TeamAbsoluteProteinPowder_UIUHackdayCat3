<?php

namespace App\Livewire\Features;

use App\Models\User;
use Livewire\Component;

class PartnerPairing extends Component
{
    public $pairingCode;
    public $myCode;

    public function mount()
    {
        $this->myCode = substr(md5(auth()->id()), 0, 6);
    }

    public function pair()
    {
        $partner = User::whereRaw("SUBSTRING(MD5(id), 1, 6) = ?", [$this->pairingCode])
            ->where('id', '!=', auth()->id())
            ->first();

        if (!$partner) {
            session()->flash('error', 'Invalid pairing code');
            return;
        }

        // Link both users
        auth()->user()->update(['partner_id' => $partner->id]);
        $partner->update(['partner_id' => auth()->id()]);

        session()->flash('message', "✨ Paired with {$partner->name}!");
        $this->pairingCode = '';
    }

    public function render()
    {
        return view('livewire.features.partner-pairing');
    }
}
