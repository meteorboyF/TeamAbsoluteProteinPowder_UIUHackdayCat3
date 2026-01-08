<div x-data="{ open: @entangle('isOpen') }">
    <!-- Trigger -->
    <button @click="open = true" class="text-xs text-gray-400 hover:text-red-500 flex items-center gap-1 transition">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-3 h-3">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M3 3v1.5M3 21v-6m0 0l2.77-.693a9 9 0 016.208.682l.108.054a9 9 0 006.086.71l3.114-.732a48.524 48.524 0 01-.005-10.499l-3.11.732a9 9 0 01-6.085-.711l-.108-.054a9 9 0 00-6.208-.682L3 4.5M3 15V4.5" />
        </svg>
        Report
    </button>

    <!-- Modal -->
    <div x-show="open" style="display: none;"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm" x-transition>
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6" @click.away="open = false">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Report Content</h3>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Reason</label>
                    <select wire:model="reason"
                        class="w-full mt-1 border-gray-300 rounded shadow-sm focus:border-red-500 focus:ring-red-500">
                        <option value="spam">Spam or Misleading</option>
                        <option value="abuse">Harassment or Abuse</option>
                        <option value="inappropriate">Inappropriate Content</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea wire:model="description" rows="3"
                        class="w-full mt-1 border-gray-300 rounded shadow-sm focus:border-red-500 focus:ring-red-500"
                        placeholder="Please provide details..."></textarea>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <button @click="open = false"
                    class="px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded">Cancel</button>
                <button wire:click="submitReport"
                    class="px-4 py-2 text-sm bg-red-600 text-white rounded hover:bg-red-700">Submit Report</button>
            </div>
        </div>
    </div>
</div>