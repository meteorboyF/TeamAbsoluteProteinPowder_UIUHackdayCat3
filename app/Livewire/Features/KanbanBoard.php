<?php

namespace App\Livewire\Features;

use Livewire\Component;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;

class KanbanBoard extends Component
{
    public $model;
    public $tasks;

    public function mount(Model $model)
    {
        $this->model = $model;
        $this->refreshTasks();
    }

    public function refreshTasks()
    {
        $this->tasks = Task::where('taskable_id', $this->model->id)
            ->where('taskable_type', get_class($this->model))
            ->get()
            ->groupBy('status');
    }

    public function updateStatus($taskId, $newStatus)
    {
        $task = Task::find($taskId);
        if ($task) {
            $task->status = $newStatus;
            $task->save();
            $this->refreshTasks();
        }
    }

    public function createTask($status = 'todo')
    {
        Task::create([
            'title' => 'New Task ' . rand(100, 999),
            'status' => $status,
            'priority' => 'medium',
            'taskable_id' => $this->model->id,
            'taskable_type' => get_class($this->model),
        ]);
        $this->refreshTasks();
    }

    public function render()
    {
        return view('livewire.features.kanban-board');
    }
}
