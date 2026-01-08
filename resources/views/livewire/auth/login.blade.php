<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <!-- Logo/Header -->
            <div class="text-center mb-8">
                <h1 class="text-5xl font-display font-bold bg-gradient-to-r from-primary-500 via-pink-500 to-purple-500 bg-clip-text text-transparent mb-3">
                    Project US
                </h1>
                <p class="text-white/60 text-lg">Welcome back to your relationship journey</p>
            </div>

            <!-- Login Card -->
            <div class="bg-white/10 backdrop-blur-2xl rounded-3xl p-8 border border-white/20 shadow-2xl">
                <form wire:submit.prevent="login" class="space-y-6">
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-white/80 mb-2">Email</label>
                        <input 
                            type="email" 
                            id="email" 
                            wire:model="email" 
                            class="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-2xl text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                            placeholder="your@email.com"
                            required
                        >
                        @error('email') 
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-white/80 mb-2">Password</label>
                        <input 
                            type="password" 
                            id="password" 
                            wire:model="password" 
                            class="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-2xl text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                            placeholder="••••••••"
                            required
                        >
                        @error('password') 
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input 
                                type="checkbox" 
                                wire:model="remember" 
                                class="w-4 h-4 rounded bg-white/5 border-white/20 text-primary-500 focus:ring-primary-500 focus:ring-offset-0"
                            >
                            <span class="text-sm text-white/60">Remember me</span>
                        </label>
                        
                        <a href="#" class="text-sm text-primary-400 hover:text-primary-300 transition-colors">
                            Forgot password?
                        </a>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full py-4 bg-gradient-to-r from-primary-500 to-pink-500 hover:from-primary-600 hover:to-pink-600 text-white font-bold rounded-2xl shadow-lg shadow-primary-500/30 hover:shadow-primary-500/50 transition-all transform hover:scale-[1.02] active:scale-[0.98]"
                    >
                        Sign In
                    </button>
                </form>

                <!-- Divider -->
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-white/10"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-secondary-900 text-white/40">or</span>
                    </div>
                </div>

                <!-- Register Link -->
                <div class="text-center">
                    <p class="text-white/60">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="text-primary-400 hover:text-primary-300 font-medium transition-colors">
                            Create one
                        </a>
                    </p>
                </div>
            </div>

            <!-- Footer -->
            <p class="text-center text-white/40 text-sm mt-8">
                By continuing, you agree to our Terms & Privacy Policy
            </p>
        </div>
    </div>
</x-guest-layout>