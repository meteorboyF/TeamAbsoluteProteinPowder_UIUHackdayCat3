<div class="min-h-full flex flex-col items-center justify-center p-6 transition-colors duration-1000 ease-in-out {{ $isActive ? 'bg-cyan-950/90' : '' }}">
    
    @if(!$isActive)
        <!-- INACTIVE STATE: Normal Red/Dark Theme -->
        <div class="text-center max-w-lg mx-auto space-y-8 animate-fade-in-up">
            <div class="space-y-4">
                <div class="w-24 h-24 bg-gradient-to-br from-cyan-400 to-blue-600 rounded-full mx-auto flex items-center justify-center shadow-lg shadow-cyan-500/30">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                    </svg>
                </div>
                <h1 class="text-4xl font-bold text-secondary-900 dark:text-white font-display">The Space</h1>
                <p class="text-secondary-500 dark:text-secondary-400 text-lg">
                    Need a moment? Activate Ghost Mode to signal healthy boundaries with a gentle blue light.
                </p>
            </div>

            <!-- Duration Selection -->
            <div class="grid grid-cols-2 gap-4">
                <button wire:click="activate(15)" class="group p-4 rounded-xl border border-secondary-200 dark:border-white/10 hover:border-cyan-500/50 hover:bg-cyan-500/10 transition-all">
                    <span class="block text-2xl font-bold text-secondary-900 dark:text-white group-hover:text-cyan-400">15m</span>
                    <span class="text-xs text-secondary-500 group-hover:text-cyan-500/70">Quick Breather</span>
                </button>
                <button wire:click="activate(45)" class="group p-4 rounded-xl border border-secondary-200 dark:border-white/10 hover:border-cyan-500/50 hover:bg-cyan-500/10 transition-all">
                    <span class="block text-2xl font-bold text-secondary-900 dark:text-white group-hover:text-cyan-400">45m</span>
                    <span class="text-xs text-secondary-500 group-hover:text-cyan-500/70">Deep Focus</span>
                </button>
                <button wire:click="activate(60)" class="group p-4 rounded-xl border border-secondary-200 dark:border-white/10 hover:border-cyan-500/50 hover:bg-cyan-500/10 transition-all">
                    <span class="block text-2xl font-bold text-secondary-900 dark:text-white group-hover:text-cyan-400">1h</span>
                    <span class="text-xs text-secondary-500 group-hover:text-cyan-500/70">Me Time</span>
                </button>
                <button wire:click="activate(120)" class="group p-4 rounded-xl border border-secondary-200 dark:border-white/10 hover:border-cyan-500/50 hover:bg-cyan-500/10 transition-all">
                    <span class="block text-2xl font-bold text-secondary-900 dark:text-white group-hover:text-cyan-400">2h</span>
                    <span class="text-xs text-secondary-500 group-hover:text-cyan-500/70">Recharge</span>
                </button>
            </div>
        </div>
    @else
        <!-- ACTIVE STATE: Ghost Mode (Blue Light) -->
        <div x-data="{ 
            endTime: {{ $endTime }},
            now: Math.floor(Date.now() / 1000),
            remaining: 0,
            init() {
                this.update();
                setInterval(() => this.update(), 1000);
            },
            update() {
                this.now = Math.floor(Date.now() / 1000);
                this.remaining = Math.max(0, this.endTime - this.now);
                if (this.remaining === 0) {
                    $wire.deactivate();
                }
            },
            format(seconds) {
                const m = Math.floor(seconds / 60);
                const s = seconds % 60;
                return `${m}:${s.toString().padStart(2, '0')}`;
            }
        }" class="text-center w-full max-w-2xl mx-auto relative z-10">
            
            <!-- Ambient Blue Glow -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-cyan-500/20 rounded-full blur-[100px] -z-10 animate-pulse"></div>

            <div class="mb-12">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-500/10 border border-cyan-400/30 text-cyan-300 text-sm font-medium uppercase tracking-wider animate-pulse">
                    <span class="w-2 h-2 rounded-full bg-cyan-400"></span>
                    Ghost Mode Active
                </span>
            </div>

            <!-- Timer -->
            <div class="font-mono text-8xl md:text-9xl font-bold text-white tracking-tighter mb-4 drop-shadow-[0_0_15px_rgba(34,211,238,0.5)]">
                <span x-text="format(remaining)">00:00</span>
            </div>
            
            <p class="text-cyan-200/60 text-xl font-light mb-16">
                Available in <span x-text="Math.ceil(remaining / 60)"></span> minutes
            </p>
            
            <!-- Visualizer Bars (CSS Animation) -->
            <div class="flex justify-center gap-1 h-12 items-end mb-16 opacity-50">
                <div class="w-2 bg-cyan-400 rounded-t-sm animate-[bounce_1s_infinite]"></div>
                <div class="w-2 bg-cyan-400 rounded-t-sm animate-[bounce_1.2s_infinite]"></div>
                <div class="w-2 bg-cyan-400 rounded-t-sm animate-[bounce_0.8s_infinite]"></div>
                <div class="w-2 bg-cyan-400 rounded-t-sm animate-[bounce_1.5s_infinite]"></div>
                <div class="w-2 bg-cyan-400 rounded-t-sm animate-[bounce_1.1s_infinite]"></div>
            </div>

            <button wire:click="deactivate" class="text-cyan-400 hover:text-white text-sm font-medium underline decoration-cyan-400/30 hover:decoration-white transition-all">
                End Session Early
            </button>
        </div>
    @endif
</div>
