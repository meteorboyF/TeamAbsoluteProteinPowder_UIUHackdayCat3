<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Blade;

Route::middleware(['web', 'auth'])->group(function () {
    // Project US: Conflict Resolution Chat
    Route::get('/conflict-chat', \App\Livewire\Features\ConflictChat::class)->name('features.conflict-chat');
    
    // Project US: The Vault
    Route::get('/features/vault', \App\Livewire\Features\Vault::class)->name('features.vault');

    // Project US: The Space (Ghost Mode)
    Route::get('/features/space', \App\Livewire\Features\Space::class)->name('features.space');

    // Zarif's Feature Routes (Chat, Uploads, Feeds)

    Route::get('/features/test', function () {
        return 'Features Route Works';
    });

    // 1. Recursive Comments Test
    Route::get('/features/test-comments', function () {
        $user = \App\Models\User::first() ?? \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password')
        ]);

        return Blade::render(<<<'BLADE'
            <x-app-layout>
                 <div class="max-w-4xl mx-auto py-10">
                    <h1 class="text-2xl font-bold mb-5 font-display text-secondary-900">Testing Generic Comments</h1>
                    <p class="mb-5 text-secondary-500">Attaching comments to User: {{ $user->name }}</p>
                    @livewire('features.comments', ['model' => $user])
                 </div>
            </x-app-layout>
        BLADE, ['user' => $user]);
    });

    // 2. Generic Chat Test
    Route::get('/features/test-chat', function () {
        $project = \App\Models\User::first();

        return Blade::render(<<<'BLADE'
            <x-app-layout>
                <div class="max-w-2xl mx-auto py-10">
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-secondary-900 font-display">Testing Generic Chat (DM Mode)</h1>
                        <p class="text-secondary-500">Chatting with context: {{ $project->name }}</p>
                    </div>
                    @livewire('features.chat', ['model' => $project])
                </div>
            </x-app-layout>
        BLADE, ['project' => $project]);
    });

    // 3. Group Channels Test
    Route::get('/features/test-group-chat', function () {
        return Blade::render(<<<'BLADE'
            <x-app-layout>
                <div class="max-w-4xl mx-auto py-10">
                    @livewire('features.group-chat')
                </div>
            </x-app-layout>
        BLADE);
    });

    // 4. Feed & Notifications Test
    Route::get('/features/test-feed', function () {
        if (\App\Models\Log::count() == 0) {
            \App\Models\Log::create([
                'user_id' => 1,
                'type' => 'system',
                'description' => 'System initialized',
                'subject_id' => 1,
                'subject_type' => 'App\Models\User'
            ]);
        }

        return Blade::render(<<<'BLADE'
            <x-app-layout>
                <div class="max-w-xl mx-auto py-10">
                     <h1 class="font-bold text-xl mb-4 font-display text-secondary-900">Activity Feed</h1>
                     @livewire('features.activity-feed')
                </div>
            </x-app-layout>
        BLADE);
    });

    // 5. Interaction Test (Likes & Reviews)
    Route::get('/features/test-interaction', function () {
        $item = \App\Models\User::first();

        return Blade::render(<<<'BLADE'
            <x-app-layout>
                <div class="max-w-4xl mx-auto py-10 grid gap-10">
                    <!-- Card 1: Like Button -->
                    <div class="bg-white p-6 rounded shadow w-full max-w-sm border border-secondary-200">
                        <h2 class="font-bold mb-4 text-secondary-900">Like Button</h2>
                        <div class="flex items-center justify-between">
                            <span class="text-secondary-600">Profile: {{ $item->name }}</span>
                            @livewire('features.like-button', ['model' => $item])
                        </div>
                    </div>
                    
                    <!-- Card 2: Reviews -->
                    <div class="bg-white p-6 rounded shadow w-full max-w-sm border border-secondary-200">
                        <h2 class="font-bold mb-4 text-secondary-900">Reviews & Ratings</h2>
                        @livewire('features.star-rating', ['model' => $item])
                    </div>

                    <!-- Engagement -->
                   <div class="bg-white p-6 rounded shadow w-full max-w-sm space-y-4 border border-secondary-200">
                        <h2 class="font-bold border-b border-secondary-100 pb-2 text-secondary-900">Engagement</h2>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-secondary-600">Follow User</span>
                            @livewire('features.follow-button', ['targetUserId' => $item->id])
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-secondary-600">Bookmark</span>
                            @livewire('features.bookmark-button', ['model' => $item])
                        </div>
                        <div>
                             @livewire('features.social-share', ['url' => request()->fullUrl(), 'title' => 'Check out this profile!'])
                        </div>
                   </div>
                </div>
            </x-app-layout>
        BLADE, ['item' => $item]);
    });

    // 6. Content Tools Test (Search & Upload)
    Route::get('/features/test-content', function () {
        $user = \App\Models\User::first() ?? \App\Models\User::create(['name' => 'Demo User']);

        return Blade::render(<<<'BLADE'
            <x-app-layout>
                <div class="max-w-4xl mx-auto py-10 space-y-10">
                     @livewire('features.global-search')
                     
                     <div class="bg-primary-600 text-white p-6 rounded shadow">
                        <h1 class="text-2xl font-bold font-display">Content Tools</h1>
                        <p class="text-primary-100">Press Ctrl+K for search.</p>
                     </div>

                     <div class="grid grid-cols-2 gap-8">
                        <div class="bg-white p-6 rounded shadow border border-secondary-200">
                            <h2 class="font-bold mb-4 text-secondary-900">File Uploader</h2>
                             @livewire('features.file-uploader', ['model' => $user])
                        </div>
                        <div class="space-y-8">
                             <div class="bg-white p-6 rounded shadow border border-secondary-200">
                                <h2 class="font-bold mb-4 text-secondary-900">Tags</h2>
                                @livewire('features.tag-input', ['model' => $user])
                             </div>
                             <div class="bg-white p-6 rounded shadow relative border border-secondary-200">
                                <h2 class="font-bold mb-4 text-secondary-900">Polls & Reports</h2>
                                @livewire('features.poll-widget', ['model' => $user])
                                <div class="absolute top-6 right-6">
                                     @livewire('features.report-modal', ['model' => $user])
                                </div>
                             </div>
                        </div>
                     </div>
                </div>
            </x-app-layout>
        BLADE, ['user' => $user]);
    });

    // 7. Utility & Commerce Test
    Route::get('/features/test-utility', function () {
        $user = \App\Models\User::first();

        return Blade::render(<<<'BLADE'
            <x-app-layout>
                @livewire('features.announcement-banner')
                <div class="p-10 max-w-6xl mx-auto space-y-10">
                    <h1 class="text-3xl font-bold font-display text-secondary-900">Utility & Commerce</h1>
                    <div class="grid grid-cols-2 gap-8">
                        <div>
                            <h2 class="font-bold mb-4 text-secondary-900">Inventory</h2>
                            @livewire('features.user-inventory', ['userId' => $user->id])
                        </div>
                        <div>
                             <h2 class="font-bold mb-4 text-secondary-900">Leaderboard</h2>
                             @livewire('features.leaderboard')
                        </div>
                    </div>
                     <div class="grid grid-cols-3 gap-8">
                        <div class="col-span-1">
                             <h2 class="font-bold mb-4 text-secondary-900">Events</h2>
                             @livewire('features.event-list')
                        </div>
                        <div class="col-span-2">
                             <h2 class="font-bold mb-4 text-secondary-900">Kanban</h2>
                             @livewire('features.kanban-board', ['model' => $user])
                        </div>
                     </div>
                </div>
            </x-app-layout>
        BLADE, ['user' => $user]);
    });
});
