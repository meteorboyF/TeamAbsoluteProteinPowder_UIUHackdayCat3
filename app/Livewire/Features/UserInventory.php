<?php

namespace App\Livewire\Features;

use Livewire\Component;
use App\Models\InventoryItem;

class UserInventory extends Component
{
    public $userId;
    public $items = [];

    public function mount($userId = null)
    {
        $this->userId = $userId ?? auth()->id() ?? 1; // Default to 1 for demo
        $this->refreshInventory();
    }

    public function refreshInventory()
    {
        $this->items = InventoryItem::where('user_id', $this->userId)->get();
    }

    public function useItem($itemId)
    {
        $item = InventoryItem::find($itemId);
        if ($item && $item->quantity > 0) {
            $item->decrement('quantity');
            // Logic to trigger item effect would go here
            if ($item->quantity <= 0 && $item->type === 'consumable') {
                $item->delete();
            }
            $this->refreshInventory();
        }
    }

    public function render()
    {
        return view('livewire.features.user-inventory');
    }
}
