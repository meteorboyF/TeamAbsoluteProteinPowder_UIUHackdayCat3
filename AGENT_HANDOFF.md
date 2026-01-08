# Agent Handoff Protocols - PROJECT: "US"

> [!IMPORTANT]
> **FARDEEN (CORE) HAS COMPLETED ALL BACKEND WORK.**
> The Master Vision is in [FARDEEN_CORE_BRIEF.md](file:///c:/Users/ASUS/Desktop/TeamAbsoluteProteinPowderUIUHackday/FARDEEN_CORE_BRIEF.md).
> Backend services are ready for integration.

---

## 💪 PROMPT FOR ZARIF (The Muscles)
**Role:** Interactivity, Gamification & AI Logic  
**Mission:** Build the "Resonance" (Conflict Chat) feature.

### Your Task:
Build a Livewire component for the conflict resolution chat that uses the backend services Fardeen created.

**Step-by-Step Instructions:**

1. **Pull Latest Code:**
   ```bash
   git pull origin main
   ```

2. **Create the Conflict Chat Component:**
   ```bash
   php artisan make:livewire Features/ConflictChat
   ```

3. **Build the Chat Lock Mechanism:**
   - Use `wire:model` for the message input
   - After sending 1 message, disable the input
   - Add an "Empathy Button" that unlocks the chat for the partner
   - Use Laravel Reverb (Websockets) to sync between two users

4. **Integrate Gamification:**
   ```php
   use App\Services\Features\GamificationService;
   
   $gamification = new GamificationService();
   $gamification->awardXp($userId, 'resolved_conflict', 100);
   ```

5. **Health Bar Logic:**
   - Check message for "aggressive" keywords (hate, stupid, always)
   - Decrease health bar if aggressive
   - Increase if "soft" keywords (feel, love, understand)

**Files You'll Create:**
- `app/Livewire/Features/ConflictChat.php`
- `resources/views/livewire/features/conflict-chat.blade.php`

**Route Already Exists:** `/conflict` (points to your view)

---

## 🎨 PROMPT FOR MIZI (The Skin)
**Role:** Visuals, Animations & "The Mood"  
**Mission:** Create the "Garden" (Dashboard) and "Vault" visuals.

### Your Task:
Build the UI for the Dashboard and Vault using the backend data Fardeen prepared.

**Step-by-Step Instructions:**

1. **Pull Latest Code:**
   ```bash
   git pull origin main
   ```

2. **Build The Garden (Dashboard):**
   - Edit `resources/views/dashboard.blade.php`
   - Use `$user->level()` to get the user's level (1-6)
   - Use `$user->totalXp()` to get total XP
   - Display visual state:
     - Level 1-2: Withered grass (gray/brown)
     - Level 3-4: Growing flowers (green)
     - Level 5-6: Blooming garden (gold/vibrant)

   **Example Code:**
   ```blade
   @php
       $level = auth()->user()->level();
       $state = match(true) {
           $level >= 5 => 'blooming',
           $level >= 3 => 'growing',
           default => 'withered'
       };
   @endphp
   
   <div class="garden {{ $state }}">
       <!-- Use Heroicons or Lucide for flower/plant icons -->
   </div>
   ```

3. **Build The Vault (Rub-to-Reveal):**
   - Create `resources/views/livewire/features/vault.blade.php`
   - Use `VaultService::getAccessibleItems($userId)` to get unlocked items
   - Apply `blur-xl` CSS class to images by default
   - On hover/touch, remove blur (`filter: blur(0)`)

   **Example CSS:**
   ```css
   .vault-item {
       filter: blur(20px);
       transition: filter 0.3s;
   }
   
   .vault-item:hover {
       filter: blur(0);
   }
   ```

4. **Style Guidelines:**
   - Use the existing `x-ui.card`, `x-ui.button` components
   - Dark/Glass aesthetic (already in `app.css`)
   - Use Tailwind classes only

**Files You'll Create:**
- `resources/views/dashboard.blade.php` (edit existing)
- `resources/views/livewire/features/vault.blade.php`

**Routes Already Exist:** `/vault` (points to your view)

---

## 💀 FARDEEN (The Skeleton) - STATUS
**Role:** Core Architecture, Auth, Database  
**Status:** ✅ ALL WORK COMPLETE

**What I Built:**
- SpaceService (Ghost Mode backend)
- VaultService (File storage with time-lock)
- GamificationService (XP system, 6 levels)
- All Models: User, Status, VaultItem, XpLog
- Database migrations
- Test data seeder

**Next Move:** Coordinate merging Zarif and Mizi's work.
