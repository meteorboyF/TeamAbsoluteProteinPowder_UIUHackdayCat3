<x-app-layout>
    <div class="space-y-12">
        <div class="border-b border-secondary-200 pb-5">
            <h3 class="text-2xl font-bold leading-6 text-secondary-900 font-display">Design System</h3>
            <p class="mt-2 max-w-4xl text-sm text-secondary-500">This page showcases the application's design system, including typography, colors, and reusable UI components.</p>
        </div>

        <!-- Typography -->
        <section>
            <h4 class="text-lg font-bold text-secondary-900 mb-6 border-b pb-2">Typography</h4>
            <div class="grid grid-cols-1 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-secondary-200">
                    <h1 class="text-4xl font-bold text-secondary-900 mb-2 font-display">Heading 1 (Display/Outfit)</h1>
                    <h2 class="text-3xl font-bold text-secondary-900 mb-2 font-display">Heading 2 (Display/Outfit)</h2>
                    <h3 class="text-2xl font-bold text-secondary-900 mb-2 font-display">Heading 3 (Display/Outfit)</h3>
                    <h4 class="text-xl font-bold text-secondary-900 mb-2 font-display">Heading 4 (Display/Outfit)</h4>
                    <p class="text-base text-secondary-600">Body text (Inter). Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <p class="text-sm text-secondary-500 mt-2">Small text (Inter). Ut enim ad minim veniam, quis nostrud exercitation.</p>
                </div>
            </div>
        </section>

        <!-- Buttons -->
        <section>
            <h4 class="text-lg font-bold text-secondary-900 mb-6 border-b pb-2">Buttons (`x-ui.button`)</h4>
            <div class="space-y-4">
                <div class="flex flex-wrap gap-4 items-center">
                    <x-ui.button variant="primary">Primary</x-ui.button>
                    <x-ui.button variant="secondary">Secondary</x-ui.button>
                    <x-ui.button variant="danger">Danger</x-ui.button>
                    <x-ui.button variant="ghost">Ghost</x-ui.button>
                </div>
                <div class="flex flex-wrap gap-4 items-center">
                    <x-ui.button size="sm">Small</x-ui.button>
                    <x-ui.button size="md">Medium</x-ui.button>
                    <x-ui.button size="lg">Large</x-ui.button>
                </div>
            </div>
        </section>

        <!-- Cards -->
        <section>
            <h4 class="text-lg font-bold text-secondary-900 mb-6 border-b pb-2">Cards (`x-ui.card`)</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-ui.card title="Card Title">
                    <p class="text-secondary-600">This is a simple card with a title. The body content goes here.</p>
                </x-ui.card>

                <x-ui.card>
                    <p class="text-secondary-600">This is a card without a title.</p>
                    <x-slot name="footer">
                        <span class="text-sm text-secondary-500">Card Footer Content</span>
                    </x-slot>
                </x-ui.card>
            </div>
        </section>

        <!-- Inputs -->
        <section>
            <h4 class="text-lg font-bold text-secondary-900 mb-6 border-b pb-2">Inputs (`x-ui.input`)</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-2xl">
                <x-ui.input label="Email Address" name="email" placeholder="you@example.com" />
                <x-ui.input label="Password" name="password" type="password" />
                <x-ui.input label="Disabled Input" disabled value="Cannot change this" />
                <x-ui.input label="Input with Error" error="This field is required" />
                
                <x-ui.select label="Select Option" name="select">
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                </x-ui.select>

                <x-ui.textarea label="Description" placeholder="Enter details..." />

                <div class="flex items-center gap-6 mt-4">
                    <x-ui.checkbox label="Remember Me" name="remember" />
                    <x-ui.toggle label="Enable Notifications" name="notifications" checked />
                </div>
            </div>
        </section>

        <!-- Data Display -->
        <section>
            <h4 class="text-lg font-bold text-secondary-900 mb-6 border-b pb-2">Tables (`x-ui.table`)</h4>
            <x-ui.table :headers="['Name', 'Title', 'Email', 'Role']">
                <tr>
                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-secondary-900 sm:pl-6">Lindsay Walton</td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-secondary-500">Front-end Developer</td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-secondary-500">lindsay.walton@example.com</td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-secondary-500">Member</td>
                </tr>
            </x-ui.table>
        </section>

        <!-- Feedback -->
        <section>
            <h4 class="text-lg font-bold text-secondary-900 mb-6 border-b pb-2">Feedback</h4>
            
            <div class="mb-8">
                <h5 class="text-md font-semibold text-secondary-800 mb-4">Alerts (`x-ui.alert`)</h5>
                <x-ui.alert type="info" title="Information">
                    This is an info alert with a title.
                </x-ui.alert>
                <x-ui.alert type="success" dismissible>
                    Operation successful! (Dismissible)
                </x-ui.alert>
                <x-ui.alert type="warning">
                    Warning: Check your input.
                </x-ui.alert>
                <x-ui.alert type="error">
                    Error: Something went wrong.
                </x-ui.alert>
            </div>

            <div class="mb-8" x-data="{ modalOpen: false }">
                <h5 class="text-md font-semibold text-secondary-800 mb-4">Modals (`x-ui.modal`)</h5>
                <x-ui.button @click="$dispatch('open-modal', 'demo-modal')">Open Modal</x-ui.button>

                <x-ui.modal name="demo-modal" title="Demo Modal">
                    <p class="text-secondary-600">This is a modal body text. It supports any content.</p>
                    <x-slot name="footer">
                        <x-ui.button variant="primary" @click="$dispatch('close-modal', 'demo-modal')">Confirm</x-ui.button>
                        <x-ui.button variant="secondary" @click="$dispatch('close-modal', 'demo-modal')">Cancel</x-ui.button>
                    </x-slot>
                </x-ui.modal>
            </div>

            <div>
                <h5 class="text-md font-semibold text-secondary-800 mb-4">Toasts (`x-ui.toast`)</h5>
                <div class="flex gap-4">
                    <x-ui.button @click="$dispatch('notify', { type: 'success', message: 'Successfully saved!' })">
                        Trigger Success Toast
                    </x-ui.button>
                    <x-ui.button variant="danger" @click="$dispatch('notify', { type: 'error', message: 'Something went wrong.' })">
                        Trigger Error Toast
                    </x-ui.button>
                </div>
                <!-- Global Toast Container (usually in layout, here for demo) -->
                <x-ui.toast />
            </div>
        </section>
    </div>
</x-app-layout>
