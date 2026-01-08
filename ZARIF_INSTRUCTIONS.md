# ZARIF (The Muscles) - Additional Features to Build

## 📋 What Fardeen Has Built So Far

**Backend Services (All Complete):**
- ✅ SpaceService - Ghost Mode logic
- ✅ VaultService - File storage
- ✅ GamificationService - XP/Leveling system
- ✅ InsightsService - Relationship analytics
- ✅ Daily Check-In - Mood tracking

**What You've Already Built:**
- ✅ ConflictChat component (turn-based chat)
- ✅ AuraService (mock AI analysis)
- ✅ Health bar logic (keyword detection)

---

## 🚀 YOUR MISSION: Build 3 New Features

### Feature 1: Real-Time Broadcasting for Conflict Chat
**Time:** 30 minutes  
**Impact:** Makes the chat actually work between two users

#### What to Build:
Enable real-time unlocking when partner clicks "Empathy Button"

#### Step-by-Step:

1. **Install Laravel Reverb** (if not done):
   ```bash
   php artisan reverb:install
   npm install --save-dev laravel-echo pusher-js
   ```

2. **Create the Event** (`app/Events/ChatUnlocked.php`):
   ```bash
   php artisan make:event ChatUnlocked
   ```
   
   ```php
   <?php
   namespace App\Events;
   
   use Illuminate\Broadcasting\Channel;
   use Illuminate\Broadcasting\InteractsWithSockets;
   use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
   use Illuminate\Foundation\Events\Dispatchable;
   use Illuminate\Queue\SerializesModels;
   
   class ChatUnlocked implements ShouldBroadcast
   {
       use Dispatchable, InteractsWithSockets, SerializesModels;
   
       public function __construct(public int $userId)
       {
       }
   
       public function broadcastOn(): array
       {
           return [
               new Channel('user.' . $this->userId),
           ];
       }
   }
   ```

3. **Update ConflictChat Component**:
   ```php
   // In app/Livewire/Features/ConflictChat.php
   
   use App\Events\ChatUnlocked;
   
   public function unlockChat()
   {
       $partner = auth()->user()->partner;
       
       if ($partner) {
           broadcast(new ChatUnlocked($partner->id));
           session()->flash('message', '✨ You offered empathy. Chat unlocked!');
       }
       
       $this->isLocked = false;
   }
   ```

4. **Add Listener to Blade View**:
   ```blade
   <!-- At the bottom of conflict-chat.blade.php -->
   
   @push('scripts')
   <script>
   Echo.channel('user.{{ auth()->id() }}')
       .listen('ChatUnlocked', (e) => {
           @this.set('isLocked', false);
           // Show notification
           alert('💚 Your partner offered empathy. You can speak now.');
       });
   </script>
   @endpush
   ```

---

### Feature 2: XP Rewards Integration
**Time:** 15 minutes  
**Impact:** Awards XP when conflicts are resolved

#### What to Build:
Automatically give 100 XP when health bar reaches 100%

#### Step-by-Step:

1. **Update ConflictChat Component**:
   ```php
   use App\Services\Features\GamificationService;
   
   public function sendMessage(AuraService $auraService, GamificationService $gamification)
   {
       // ... existing code ...
       
       // Check if conflict is resolved (health at 100%)
       if ($this->health >= 100) {
           $gamification->awardXp(
               auth()->id(),
               'resolved_conflict',
               100
           );
           
           session()->flash('message', '🎉 Conflict resolved! +100 XP');
       }
   }
   ```

---

### Feature 3: Mood Timeline Chart
**Time:** 45 minutes  
**Impact:** Visual data showing relationship trends

#### What to Build:
A chart showing mood history over the last 30 days

#### Step-by-Step:

1. **Create MoodService** (`app/Services/Features/MoodService.php`):
   ```php
   <?php
   namespace App\Services\Features;
   
   use App\Models\Mood;
   use Carbon\Carbon;
   
   class MoodService
   {
       public function getMoodTimeline(int $userId, int $days = 30): array
       {
           $moods = Mood::where('user_id', $userId)
               ->where('date', '>=', Carbon::now()->subDays($days))
               ->orderBy('date', 'asc')
               ->get();
           
           $timeline = [];
           
           foreach ($moods as $mood) {
               $timeline[] = [
                   'date' => $mood->date->format('M d'),
                   'mood' => $mood->mood,
                   'value' => $this->moodToValue($mood->mood),
               ];
           }
           
           return $timeline;
       }
       
       private function moodToValue(string $mood): int
       {
           return match($mood) {
               'happy' => 3,
               'neutral' => 2,
               'sad' => 1,
               default => 2,
           };
       }
   }
   ```

2. **Create Livewire Component**:
   ```bash
   php artisan make:livewire Features/MoodTimeline
   ```
   
   ```php
   <?php
   namespace App\Livewire\Features;
   
   use App\Services\Features\MoodService;
   use Livewire\Component;
   
   class MoodTimeline extends Component
   {
       public function render(MoodService $moodService)
       {
           $timeline = $moodService->getMoodTimeline(auth()->id());
           
           return view('livewire.features.mood-timeline', [
               'timeline' => $timeline
           ]);
       }
   }
   ```

3. **Create View with Chart.js**:
   ```blade
   <!-- resources/views/livewire/features/mood-timeline.blade.php -->
   
   <div>
       <h3 class="text-lg font-bold text-secondary-900 mb-4">Mood Timeline (Last 30 Days)</h3>
       
       <div class="bg-white p-6 rounded-lg border border-secondary-200">
           <canvas id="moodChart" height="100"></canvas>
       </div>
       
       @push('scripts')
       <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
       <script>
       const ctx = document.getElementById('moodChart');
       const timeline = @json($timeline);
       
       new Chart(ctx, {
           type: 'line',
           data: {
               labels: timeline.map(t => t.date),
               datasets: [{
                   label: 'Mood',
                   data: timeline.map(t => t.value),
                   borderColor: '#9333ea',
                   backgroundColor: 'rgba(147, 51, 234, 0.1)',
                   tension: 0.4,
                   fill: true
               }]
           },
           options: {
               responsive: true,
               plugins: {
                   legend: {
                       display: false
                   }
               },
               scales: {
                   y: {
                       min: 0,
                       max: 4,
                       ticks: {
                           callback: function(value) {
                               return ['', 'Sad', 'Neutral', 'Happy'][value] || '';
                           }
                       }
                   }
               }
           }
       });
       </script>
       @endpush
   </div>
   ```

4. **Add to Dashboard**:
   ```blade
   <!-- In resources/views/dashboard.blade.php, add: -->
   
   <div class="mt-6">
       @livewire('features.mood-timeline')
   </div>
   ```

---

### Feature 4: Partner Pairing System
**Time:** 30 minutes  
**Impact:** Allows users to link with their partner

#### What to Build:
A simple pairing code system

#### Step-by-Step:

1. **Create Pairing Component**:
   ```bash
   php artisan make:livewire Features/PartnerPairing
   ```
   
   ```php
   <?php
   namespace App\Livewire\Features;
   
   use App\Models\User;
   use Livewire\Component;
   
   class PartnerPairing extends Component
   {
       public $pairingCode;
       public $myCode;
       
       public function mount()
       {
           $this->myCode = substr(md5(auth()->id()), 0, 6);
       }
       
       public function pair()
       {
           $partner = User::whereRaw("SUBSTRING(MD5(id), 1, 6) = ?", [$this->pairingCode])
               ->where('id', '!=', auth()->id())
               ->first();
           
           if (!$partner) {
               session()->flash('error', 'Invalid pairing code');
               return;
           }
           
           // Link both users
           auth()->user()->update(['partner_id' => $partner->id]);
           $partner->update(['partner_id' => auth()->id()]);
           
           session()->flash('message', "✨ Paired with {$partner->name}!");
           $this->pairingCode = '';
       }
       
       public function render()
       {
           return view('livewire.features.partner-pairing');
       }
   }
   ```

2. **Create View**:
   ```blade
   <div>
       @if(auth()->user()->partner_id)
           <x-ui.card>
               <div class="text-center py-6">
                   <div class="text-6xl mb-4">💑</div>
                   <p class="text-lg font-bold text-secondary-900">
                       Paired with {{ auth()->user()->partner->name }}
                   </p>
               </div>
           </x-ui.card>
       @else
           <x-ui.card title="Pair with Your Partner">
               <div class="space-y-6">
                   <div>
                       <p class="text-sm text-secondary-600 mb-2">Your Pairing Code:</p>
                       <div class="bg-purple-50 border-2 border-purple-200 rounded-lg p-4 text-center">
                           <p class="text-3xl font-bold text-purple-600 tracking-widest">{{ $myCode }}</p>
                       </div>
                       <p class="text-xs text-secondary-500 mt-2">Share this code with your partner</p>
                   </div>
                   
                   <div>
                       <label class="block text-sm font-medium text-secondary-700 mb-2">
                           Enter Partner's Code:
                       </label>
                       <input type="text" wire:model="pairingCode" 
                              class="block w-full rounded-lg border-secondary-300 uppercase tracking-widest text-center text-2xl font-bold"
                              placeholder="ABC123"
                              maxlength="6">
                   </div>
                   
                   <x-ui.button wire:click="pair" variant="primary" class="w-full">
                       Pair Now
                   </x-ui.button>
                   
                   @if(session()->has('message'))
                       <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                           {{ session('message') }}
                       </div>
                   @endif
                   
                   @if(session()->has('error'))
                       <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                           {{ session('error') }}
                       </div>
                   @endif
               </div>
           </x-ui.card>
       @endif
   </div>
   ```

---

## ✅ Testing Checklist

- [ ] Real-time chat unlock works between two browsers
- [ ] XP awarded when conflict resolved
- [ ] Mood timeline chart displays correctly
- [ ] Partner pairing works with code
- [ ] All features mobile responsive

**Estimated Time:** 2 hours total

---

## 🎯 Priority Order

1. **Partner Pairing** (needed for other features to work)
2. **XP Integration** (quick win)
3. **Real-Time Broadcasting** (impressive demo)
4. **Mood Timeline** (visual polish)
