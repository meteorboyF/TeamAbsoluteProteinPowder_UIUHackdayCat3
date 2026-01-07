<div class="grid grid-cols-3 gap-4 h-96">
    @foreach(['todo' => 'To Do', 'doing' => 'In Progress', 'done' => 'Done'] as $status => $label)
        <div class="bg-gray-100 rounded-lg p-3 flex flex-col">
            <div class="flex justify-between items-center mb-3">
                <h4 class="font-bold text-gray-700 text-sm uppercase">{{ $label }}</h4>
                <button wire:click="createTask('{{ $status }}')"
                    class="text-gray-400 hover:text-blue-600 text-xl">+</button>
            </div>

            <div class="flex-1 overflow-y-auto space-y-2">
                @foreach($tasks[$status] ?? [] as $task)
                    <div class="bg-white p-3 rounded shadow-sm border hover:border-blue-300 group">
                        <div class="text-sm font-medium text-gray-800 mb-2">{{ $task->title }}</div>
                        <div class="flex justify-between items-center">
                            <span
                                class="text-[10px] px-1.5 py-0.5 rounded bg-gray-200 text-gray-600 uppercase">{{ $task->priority }}</span>

                            <!-- Move Controls (Simple MVP) -->
                            <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition">
                                @if($status !== 'todo')
                                    <button wire:click="updateStatus('{{ $task->id }}', 'todo')"
                                        class="text-xs text-gray-400 hover:text-blue-500" title="Move to Todo">&larr;</button>
                                @endif
                                @if($status !== 'doing')
                                    <button wire:click="updateStatus('{{ $task->id }}', 'doing')"
                                        class="text-xs text-gray-400 hover:text-yellow-500" title="Move to Doing">&harr;</button>
                                @endif
                                @if($status !== 'done')
                                    <button wire:click="updateStatus('{{ $task->id }}', 'done')"
                                        class="text-xs text-gray-400 hover:text-green-500" title="Move to Done">&rarr;</button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>