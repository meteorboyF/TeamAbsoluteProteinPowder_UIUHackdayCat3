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
            </div>
        </section>
    </div>
</x-app-layout>
