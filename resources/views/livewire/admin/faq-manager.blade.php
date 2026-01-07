<div class="p-6 bg-white shadow rounded-lg">
    <h2 class="text-xl font-bold mb-4">FAQ Manager</h2>

    <form wire:submit.prevent="create" class="mb-8 space-y-4">
        <div>
            <label class="block text-sm font-medium">Question</label>
            <input type="text" wire:model="question" class="w-full border-gray-300 rounded shadow-sm">
        </div>
        <div>
            <label class="block text-sm font-medium">Answer</label>
            <textarea wire:model="answer" class="w-full border-gray-300 rounded shadow-sm"></textarea>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Add FAQ</button>
    </form>

    <div class="space-y-4">
        @foreach($faqs as $faq)
            <div class="border rounded p-4">
                <h3 class="font-bold">{{ $faq->question }}</h3>
                <p class="text-gray-600">{{ $faq->answer }}</p>
                <span class="text-xs bg-gray-100 px-2 py-1 rounded">{{ $faq->category }}</span>
            </div>
        @endforeach
    </div>
</div>