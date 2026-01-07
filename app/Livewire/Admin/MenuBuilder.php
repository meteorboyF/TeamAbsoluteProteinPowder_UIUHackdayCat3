<?php

namespace App\Livewire\Admin;

use App\Models\MenuItem;
use Livewire\Component;

class MenuBuilder extends Component
{
    public $label, $url;
    public $items;

    protected $rules = [
        'label' => 'required',
        'url' => 'required',
    ];

    public function mount()
    {
        $this->refreshItems();
    }

    public function refreshItems()
    {
        $this->items = MenuItem::whereNull('parent_id')->orderBy('order')->get();
    }

    public function create()
    {
        $this->validate();

        $maxOrder = MenuItem::whereNull('parent_id')->max('order') ?? 0;

        MenuItem::create([
            'label' => $this->label,
            'url' => $this->url,
            'order' => $maxOrder + 1,
            'is_active' => true,
        ]);

        $this->reset(['label', 'url']);
        $this->refreshItems();
    }

    public function delete($id)
    {
        MenuItem::destroy($id);
        $this->refreshItems();
    }

    public function moveUp($id)
    {
        $item = MenuItem::find($id);
        if ($item) {
            $prev = MenuItem::where('order', '<', $item->order)->orderBy('order', 'desc')->first();
            if ($prev) {
                $temp = $item->order;
                $item->update(['order' => $prev->order]);
                $prev->update(['order' => $temp]);
            }
        }
        $this->refreshItems();
    }

    public function render()
    {
        return view('livewire.admin.menu-builder')->layout('layouts.app');
    }
}
