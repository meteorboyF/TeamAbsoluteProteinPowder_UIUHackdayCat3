<div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8 bg-secondary-50">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-secondary-900 font-display">
            Sign in to your account
        </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <x-ui.card>
            <form class="space-y-6" wire:submit.prevent="login">
                
                <x-ui.input label="Email address" 
                            name="email" 
                            type="email" 
                            wire:model="email" 
                            required 
                            autofocus />

                <x-ui.input label="Password" 
                            name="password" 
                            type="password" 
                            wire:model="password" 
                            required />

                <div class="flex items-center justify-between">
                    <x-ui.checkbox label="Remember me" 
                                   name="remember" 
                                   wire:model="remember" />

                    <div class="text-sm">
                        <a href="#" class="font-medium text-primary-600 hover:text-primary-500">
                            Forgot your password?
                        </a>
                    </div>
                </div>
                
                @if($errors->any())
                    <x-ui.alert type="error" title="Error">
                        {{ $errors->first() }}
                    </x-ui.alert>
                @endif

                <div>
                    <x-ui.button type="submit" class="w-full justify-center">
                        Sign in
                    </x-ui.button>
                </div>
            </form>

            <x-slot name="footer">
                <div class="text-center text-sm">
                    <span class="text-secondary-600">Don't have an account?</span>
                    <a href="{{ route('register') }}" class="font-medium text-primary-600 hover:text-primary-500">
                        Register
                    </a>
                </div>
            </x-slot>
        </x-ui.card>
    </div>
</div>