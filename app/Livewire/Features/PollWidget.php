<?php

namespace App\Livewire\Features;

use Livewire\Component;
use Illuminate\Database\Eloquent\Model;
use App\Models\Poll;

class PollWidget extends Component
{
    public $model;
    public $poll;

    // Creation State
    public $isCreating = false;
    public $newQuestion = '';
    public $newOptions = ['', ''];

    public function mount(Model $model)
    {
        $this->model = $model;
        $this->refreshPoll();
    }

    public function refreshPoll()
    {
        // Simple 1-poll-per-item logic for demo
        $this->poll = Poll::where('pollable_id', $this->model->id)
            ->where('pollable_type', get_class($this->model))
            ->latest()
            ->first();
    }

    public function addOption()
    {
        $this->newOptions[] = '';
    }

    public function removeOption($index)
    {
        unset($this->newOptions[$index]);
        $this->newOptions = array_values($this->newOptions);
    }

    public function createPoll()
    {
        $this->validate([
            'newQuestion' => 'required|string|min:5',
            'newOptions' => 'required|array|min:2',
            'newOptions.*' => 'required|string',
        ]);

        Poll::create([
            'question' => $this->newQuestion,
            'options' => array_values($this->newOptions), // Ensure indexed array
            'votes' => [],
            'pollable_id' => $this->model->id,
            'pollable_type' => get_class($this->model),
            'user_id' => auth()->id() ?? 1,
            'is_active' => true
        ]);

        $this->isCreating = false;
        $this->refreshPoll();
    }

    public function vote($optionIndex)
    {
        if (!$this->poll)
            return;

        $userId = auth()->id() ?? 'anon_user'; // Mock user

        $votes = $this->poll->votes ?? [];

        // Remove previous vote if exists
        // (Simple dictionary of userId => index would be better, but generic array in Mongo:)
        // Let's assume votes is associative array ['userId' => optionIndex]

        $votes[$userId] = $optionIndex;

        $this->poll->votes = $votes;
        $this->poll->save();
        $this->refreshPoll();
    }

    public function render()
    {
        $results = [];
        $totalVotes = 0;

        if ($this->poll) {
            $votes = $this->poll->votes ?? [];
            $totalVotes = count($votes);

            // Initialize counts
            foreach ($this->poll->options as $index => $opt) {
                $results[$index] = 0;
            }

            // Tally
            foreach ($votes as $uid => $optIndex) {
                if (isset($results[$optIndex])) {
                    $results[$optIndex]++;
                }
            }
        }

        return view('livewire.features.poll-widget', [
            'results' => $results,
            'totalVotes' => $totalVotes
        ]);
    }
}
