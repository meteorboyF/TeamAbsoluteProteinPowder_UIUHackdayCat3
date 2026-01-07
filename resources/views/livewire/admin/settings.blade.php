<div class="space-y-6" x-data="{ activeTab: 'general' }">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-secondary-900 font-display">Settings</h2>
            <p class="text-sm text-secondary-500">Manage application configuration and features.</p>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <div class="border-b border-secondary-200">
        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
            <button @click="activeTab = 'general'"
                :class="activeTab === 'general'
                    ? 'border-primary-500 text-primary-600'
                    : 'border-transparent text-secondary-500 hover:border-secondary-300 hover:text-secondary-700'"
                class="whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium">
                General
            </button>
            <button @click="activeTab = 'features'"
                :class="activeTab === 'features'
                    ? 'border-primary-500 text-primary-600'
                    : 'border-transparent text-secondary-500 hover:border-secondary-300 hover:text-secondary-700'"
                class="whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium">
                Feature Flags
            </button>
        </nav>
    </div>

    <!-- General Settings Tab -->
    <div x-show="activeTab === 'general'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
        <x-ui.card title="Application Configuration">
            <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-4">
                    <x-ui.input label="Site Name" name="site_name" value="Absolute SaaS" />
                </div>

                <div class="col-span-full">
                    <x-ui.input label="Support Email" name="support_email" type="email" value="help@absolutesaas.com" />
                </div>

                <div class="sm:col-span-3">
                    <x-ui.select label="Timezone" name="timezone">
                        <option>UTC</option>
                        <option>Asia/Dhaka</option>
                        <option>America/New_York</option>
                    </x-ui.select>
                </div>
            </div>
            <x-slot name="footer">
                <div class="flex justify-end">
                    <x-ui.button>Save Changes</x-ui.button>
                </div>
            </x-slot>
        </x-ui.card>
    </div>

    <!-- Feature Flags Tab -->
    <div x-show="activeTab === 'features'" style="display: none;" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
        <x-ui.card title="System Features">
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-medium leading-6 text-secondary-900">User Registration</h3>
                        <p class="mt-1 text-sm text-secondary-500">Allow new users to sign up.</p>
                    </div>
                    <x-ui.toggle name="feature_registration" checked />
                </div>
                <div class="border-t border-secondary-100 my-4"></div>
                
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-medium leading-6 text-secondary-900">Beta Features</h3>
                        <p class="mt-1 text-sm text-secondary-500">Enable experimental features for all users.</p>
                    </div>
                    <x-ui.toggle name="feature_beta" />
                </div>
                <div class="border-t border-secondary-100 my-4"></div>

                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-medium leading-6 text-secondary-900">Maintenance Mode</h3>
                        <p class="mt-1 text-sm text-secondary-500">Take the site offline for everyone except admins.</p>
                    </div>
                    <x-ui.toggle name="maintenance_mode" />
                </div>
            </div>
            <x-slot name="footer">
                <div class="flex justify-end">
                    <x-ui.button>Update Features</x-ui.button>
                </div>
            </x-slot>
        </x-ui.card>
    </div>
</div>
