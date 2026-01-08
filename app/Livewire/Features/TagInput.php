<?php

namespace App\Livewire\Features;

use Livewire\Component;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;

class TagInput extends Component
{
    public $model;
    public $tags = []; // Current tags on the model
    public $newTag = '';
    public $suggestions = [];

    public function mount(Model $model)
    {
        $this->model = $model;
        // In MongoDB, we can just store tags as an array on the model for simplicity
        // Or generic relation. For this Hackathon skeleton, distinct 'tags' array field is best.
        $this->tags = $model->tags ?? [];
    }

    public function updatedNewTag()
    {
        if (strlen($this->newTag) < 2) {
            $this->suggestions = [];
            return;
        }

        $this->suggestions = Tag::where('name', 'like', "%{$this->newTag}%")
            ->take(5)
            ->pluck('name')
            ->toArray();
    }

    public function addTag($name = null)
    {
        $name = $name ?? $this->newTag;
        if (empty($name))
            return;

        if (!in_array($name, $this->tags)) {
            $this->tags[] = $name;

            // Persist Tag to global list
            $tag = Tag::firstOrCreate(['name' => $name]);
            $tag->increment('count');

            // Persist simple array to model
            $this->model->tags = $this->tags;
            $this->model->save();
        }

        $this->newTag = '';
        $this->suggestions = [];
    }

    public function removeTag($index)
    {
        unset($this->tags[$index]);
        $this->tags = array_values($this->tags);

        $this->model->tags = $this->tags;
        $this->model->save();
    }

    public function render()
    {
        return view('livewire.features.tag-input');
    }
}
