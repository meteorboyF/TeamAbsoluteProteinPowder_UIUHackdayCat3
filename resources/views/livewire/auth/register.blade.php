<div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-secondary-900 font-display">
            Create your account
        </h2>
    </div>

    <x-ui.card
        class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-xl overflow-hidden sm:rounded-2xl border border-secondary-100">
        <h2 class="text-2xl font-bold text-secondary-900 mb-6 text-center">Create Account</h2>

        <form wire:submit="register">
            <!-- Name -->
            <div>
                <x-ui.input-label for="name" value="{{ __('Name') }}" />
                <x-ui.text-input id="name" class="block mt-1 w-full" type="text" name="name" wire:model="name" required
                    autofocus autocomplete="name" placeholder="Your Name" />
                <x-ui.input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-ui.input-label for="email" value="{{ __('Email') }}" />
                <x-ui.text-input id="email" class="block mt-1 w-full" type="email" name="email" wire:model="email"
                    required autocomplete="username" placeholder="you@example.com" />
                <x-ui.input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-ui.input-label for="password" value="{{ __('Password') }}" />
                <x-ui.text-input id="password" class="block mt-1 w-full" type="password" name="password"
                    wire:model="password" required autocomplete="new-password" placeholder="••••••••" />
                <x-ui.input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-ui.input-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-ui.text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" wire:model="password_confirmation" required autocomplete="new-password"
                    placeholder="••••••••" />
                <x-ui.input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4 mb-6">
                <a class="underline text-sm text-secondary-600 hover:text-secondary-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
            </div>

            <x-ui.button class="w-full justify-center py-3 text-lg">
                {{ __('Register') }}
            </x-ui.button>
        </form>
    </x-ui.card>
</div>