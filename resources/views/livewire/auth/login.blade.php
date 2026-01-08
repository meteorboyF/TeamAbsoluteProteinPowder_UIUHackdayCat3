<div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-secondary-900 font-display">
            Sign in to your account
        </h2>
    </div>

    <x-ui.card
        class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-xl overflow-hidden sm:rounded-2xl border border-secondary-100">
        <h2 class="text-2xl font-bold text-secondary-900 mb-6 text-center">Welcome Back</h2>

        <form wire:submit="login">
            <!-- Email Address -->
            <div>
                <x-ui.input-label for="email" value="{{ __('Email') }}" />
                <x-ui.text-input id="email" class="block mt-1 w-full" type="email" name="email" wire:model="email"
                    required autofocus autocomplete="username" placeholder="you@example.com" />
                <x-ui.input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-ui.input-label for="password" value="{{ __('Password') }}" />
                <x-ui.text-input id="password" class="block mt-1 w-full" type="password" name="password"
                    wire:model="password" required autocomplete="current-password" placeholder="••••••••" />
                <x-ui.input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember" class="inline-flex items-center">
                    <input id="remember" type="checkbox" wire:model="remember"
                        class="rounded border-secondary-300 text-purple-600 shadow-sm focus:ring-purple-500">
                    <span class="ms-2 text-sm text-secondary-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4 mb-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-secondary-600 hover:text-secondary-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <x-ui.button class="w-full justify-center py-3 text-lg">
                {{ __('Log in') }}
            </x-ui.button>
        </form>

        <div class="mt-6 text-center text-sm text-secondary-600">
            Don't have an account?
            <a href="{{ route('register') }}" class="font-bold text-purple-600 hover:text-purple-500">
                Sign up
            </a>
        </div>
    </x-ui.card>
</div>