# MIZI (The Skin) - Comprehensive UI Build Instructions

## 📋 What Fardeen Has Built So Far

**Backend Services (All Complete):**
- ✅ SpaceService - Ghost Mode logic
- ✅ VaultService - File storage with time-lock
- ✅ GamificationService - XP system (6 levels)
- ✅ InsightsService - Relationship analytics
- ✅ Daily Check-In - Mood tracking with streak counter

**Database:**
- ✅ Users, Statuses, VaultItems, XpLogs, Moods tables
- ✅ All migrations run successfully

**What's Already Done:**
- ✅ Landing page (`welcome.blade.php`)
- ✅ Dashboard with Garden visualization (`dashboard.blade.php`)
- ✅ Daily Check-In component (fully functional)

---

## 🎨 YOUR MISSION: Build 2 Core UI Features

### Feature 1: The Vault (Photo Gallery)
**Route:** `/vault` (already registered)  
**Backend:** `VaultService` ready to use  
**Time:** 45 minutes

![Vault Wireframe](C:/Users/ASUS/.gemini/antigravity/brain/c74511e8-ae69-4359-9ca3-17f78c6fb9e8/vault_ui_wireframe_1767855074166.png)

#### What to Build:
A photo gallery where images are blurred until you hover/touch them.

#### Step-by-Step:

1. **Create the Livewire Component:**
   ```bash
   php artisan make:livewire Features/Vault
   ```

2. **Build the Component Logic** (`app/Livewire/Features/Vault.php`):
   ```php
   <?php
   namespace App\Livewire\Features;
   
   use App\Services\Features\VaultService;
   use Livewire\Component;
   use Livewire\WithFileUploads;
   
   class Vault extends Component
   {
       use WithFileUploads;
       
       public $photo;
       public $unlockDate;
       
       public function upload(VaultService $vault)
       {
           $this->validate([
               'photo' => 'image|max:5120',
           ]);
           
           $vault->uploadItem(
               auth()->id(),
               $this->photo,
               $this->unlockDate
           );
           
           $this->photo = null;
           session()->flash('message', '✨ Memory saved to The Vault!');
       }
       
       public function render(VaultService $vault)
       {
           $items = $vault->getAccessibleItems(auth()->id());
           
           return view('livewire.features.vault', [
               'items' => $items
           ]);
       }
   }
   ```

3. **Build the View** (`resources/views/livewire/features/vault.blade.php`):
   ```blade
   <div class="max-w-6xl mx-auto py-10 px-6">
       <!-- Header -->
       <div class="flex items-center justify-between mb-8">
           <div>
               <h1 class="text-3xl font-bold text-secondary-900 font-display flex items-center gap-3">
                   <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                   </svg>
                   The Vault
               </h1>
               <p class="text-secondary-600">Your private memory sanctuary</p>
           </div>
       </div>
   
       <!-- Upload Form -->
       <x-ui.card class="mb-8">
           <h3 class="font-bold text-lg mb-4 text-secondary-900">Add New Memory</h3>
           <form wire:submit.prevent="upload" class="space-y-4">
               <div>
                   <label class="block text-sm font-medium text-secondary-700 mb-2">Upload Photo</label>
                   <input type="file" wire:model="photo" accept="image/*" 
                          class="block w-full text-sm text-secondary-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100">
                   @error('photo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
               </div>
               
               <div>
                   <label class="block text-sm font-medium text-secondary-700 mb-2">Unlock Date (Optional)</label>
                   <input type="date" wire:model="unlockDate" 
                          class="block w-full rounded-lg border-secondary-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                   <p class="text-xs text-secondary-500 mt-1">Leave empty to unlock immediately</p>
               </div>
               
               <x-ui.button type="submit" variant="primary">
                   Save to Vault
               </x-ui.button>
           </form>
           
           @if(session()->has('message'))
               <div class="mt-4 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                   {{ session('message') }}
               </div>
           @endif
       </x-ui.card>
   
       <!-- Photo Grid -->
       <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
           @forelse($items as $item)
               <div class="vault-item-container group">
                   <div class="relative overflow-hidden rounded-lg aspect-square bg-secondary-100 border-2 border-secondary-200">
                       @if($item['type'] === 'photo')
                           <img src="{{ $item['url'] }}" 
                                class="w-full h-full object-cover transition-all duration-500
                                       {{ $item['is_hidden'] ? 'blur-xl group-hover:blur-none scale-110 group-hover:scale-100' : '' }}"
                                alt="Memory">
                           
                           @if($item['is_hidden'])
                               <div class="absolute inset-0 flex flex-col items-center justify-center 
                                           bg-gradient-to-br from-purple-500/30 to-pink-500/30 
                                           group-hover:opacity-0 transition-opacity duration-500 pointer-events-none">
                                   <svg class="w-12 h-12 text-white mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                   </svg>
                                   <p class="text-white text-sm font-medium">Hover to reveal</p>
                               </div>
                           @endif
                       @endif
                   </div>
                   <p class="text-xs text-secondary-500 mt-2 text-center">
                       {{ \Carbon\Carbon::parse($item['created_at'])->diffForHumans() }}
                   </p>
               </div>
           @empty
               <div class="col-span-full text-center py-16">
                   <div class="text-6xl mb-4">📸</div>
                   <p class="text-secondary-600 text-lg">No memories yet</p>
                   <p class="text-secondary-500 text-sm">Upload your first photo above</p>
               </div>
           @endforelse
       </div>
   </div>
   ```

4. **Add Custom CSS** (in `resources/css/app.css`):
   ```css
   .vault-item-container:hover img {
       transform: scale(1.05);
   }
   ```

---

### Feature 2: The Space (Ghost Mode UI)
**Route:** `/space` (already registered)  
**Backend:** `SpaceService` ready to use  
**Time:** 30 minutes

![Space Wireframe](C:/Users/ASUS/.gemini/antigravity/brain/c74511e8-ae69-4359-9ca3-17f78c6fb9e8/space_feature_wireframe_1767855095021.png)

#### What to Build:
A calming interface to activate "I need space" mode.

#### Step-by-Step:

1. **Create Component:**
   ```bash
   php artisan make:livewire Features/Space
   ```

2. **Build Logic** (`app/Livewire/Features/Space.php`):
   ```php
   <?php
   namespace App\Livewire\Features;
   
   use App\Services\Features\SpaceService;
   use Livewire\Component;
   
   class Space extends Component
   {
       public $isGhostMode = false;
       public $partnerStatus = null;
       
       public function mount(SpaceService $space)
       {
           $currentStatus = auth()->user()->currentStatus;
           $this->isGhostMode = $currentStatus && $currentStatus->type === 'ghost';
           $this->partnerStatus = $space->checkPartnerStatus(auth()->id());
       }
       
       public function toggleGhostMode(SpaceService $space)
       {
           if ($this->isGhostMode) {
               $space->deactivateGhostMode(auth()->id());
               $this->isGhostMode = false;
           } else {
               $space->activateGhostMode(auth()->id(), 120); // 2 hours
               $this->isGhostMode = true;
           }
       }
       
       public function render()
       {
           return view('livewire.features.space');
       }
   }
   ```

3. **Build View** (`resources/views/livewire/features/space.blade.php`):
   ```blade
   <div class="max-w-2xl mx-auto py-10 px-6">
       <div class="text-center mb-8">
           <h1 class="text-3xl font-bold text-secondary-900 font-display mb-2">The Space</h1>
           <p class="text-secondary-600">Sometimes we need distance to feel closer</p>
       </div>
   
       <!-- Ghost Mode Toggle -->
       <x-ui.card class="mb-6">
           <div class="text-center py-8">
               <button wire:click="toggleGhostMode" 
                       class="relative inline-flex items-center justify-center w-64 h-64 rounded-full transition-all duration-500
                              {{ $isGhostMode ? 'bg-gradient-to-br from-blue-400 to-blue-600 shadow-2xl shadow-blue-500/50' : 'bg-secondary-100 hover:bg-secondary-200' }}">
                   
                   @if($isGhostMode)
                       <div class="text-center">
                           <div class="text-8xl mb-4 animate-pulse">🌙</div>
                           <p class="text-white font-bold text-xl">Ghost Mode Active</p>
                       </div>
                   @else
                       <div class="text-center">
                           <div class="text-6xl mb-4">🤍</div>
                           <p class="text-secondary-700 font-medium">I Need Space</p>
                       </div>
                   @endif
               </button>
               
               @if($isGhostMode)
                   <p class="text-secondary-600 mt-6">Your partner sees a calm blue light</p>
               @endif
           </div>
       </x-ui.card>
   
       <!-- Partner Status -->
       @if($partnerStatus)
           <x-ui.card>
               <div class="flex items-center gap-4">
                   @if($partnerStatus['type'] === 'ghost')
                       <div class="w-16 h-16 rounded-full bg-blue-400 flex items-center justify-center animate-pulse">
                           <div class="text-3xl">🌙</div>
                       </div>
                       <div>
                           <p class="font-bold text-secondary-900">{{ $partnerStatus['message'] }}</p>
                           <p class="text-sm text-secondary-600">Give them time and space</p>
                       </div>
                   @else
                       <div class="w-16 h-16 rounded-full bg-green-400 flex items-center justify-center">
                           <div class="text-3xl">💚</div>
                       </div>
                       <div>
                           <p class="font-bold text-secondary-900">Partner is available</p>
                           <p class="text-sm text-secondary-600">They're ready to connect</p>
                       </div>
                   @endif
               </div>
           </x-ui.card>
       @endif
   </div>
   ```

---

## 🎨 Design Guidelines

**Colors:**
- Purple: `#9333ea` (primary actions)
- Blue: `#3b82f6` (ghost mode)
- Pink: `#ec4899` (accents)

**Animations:**
- Use `transition-all duration-500` for smooth effects
- Add `animate-pulse` for active states
- Blur effect: `blur-xl` → `blur-none` on hover

**Components to Use:**
- `<x-ui.card>` - For containers
- `<x-ui.button>` - For actions
- Heroicons - For icons

---

## ✅ Testing Checklist

- [ ] Vault: Upload a photo
- [ ] Vault: Hover to reveal blurred image
- [ ] Vault: Set unlock date for time capsule
- [ ] Space: Toggle Ghost Mode on/off
- [ ] Space: See partner's status
- [ ] Both: Mobile responsive

**Estimated Time:** 75 minutes total
