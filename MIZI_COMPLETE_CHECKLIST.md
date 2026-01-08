# MIZI - COMPLETE UI BUILD CHECKLIST
## Every Single Thing You Must Create

---

## 🎯 CRITICAL: Files You Will Create (NEW FILES ONLY)

### File 1: The Vault UI ⭐⭐⭐ MUST HAVE
**Path:** `resources/views/livewire/features/vault.blade.php`  
**Status:** ❌ DOES NOT EXIST  
**Time:** 45 minutes

#### What to Build:
1. **Header Section**
   - [ ] Title "The Vault" with lock icon
   - [ ] Subtitle "Your private memory sanctuary"

2. **Upload Form Card**
   - [ ] File input (styled, accepts images)
   - [ ] Date picker for unlock date (optional)
   - [ ] "Save to Vault" button (purple)
   - [ ] Success message display
   - [ ] Error message display

3. **Photo Grid**
   - [ ] Responsive grid (2 cols mobile, 3 tablet, 4 desktop)
   - [ ] Each photo card with:
     - [ ] Blurred image (blur-xl class)
     - [ ] "Hover to reveal" overlay
     - [ ] Eye icon
     - [ ] Timestamp below
   - [ ] Hover effect removes blur
   - [ ] Scale animation on hover

4. **Empty State**
   - [ ] Camera emoji (📸)
   - [ ] "No memories yet" text
   - [ ] "Upload your first photo above" subtext

**Complete Code:** See `MIZI_INSTRUCTIONS.md` lines 30-120

---

### File 2: The Space UI ⭐⭐⭐ MUST HAVE
**Path:** `resources/views/livewire/features/space.blade.php`  
**Status:** ❌ DOES NOT EXIST  
**Time:** 30 minutes

#### What to Build:
1. **Header Section**
   - [ ] Title "The Space"
   - [ ] Subtitle "Sometimes we need distance to feel closer"

2. **Ghost Mode Toggle**
   - [ ] Large circular button (256x256px)
   - [ ] Inactive state: Gray background, white heart emoji
   - [ ] Active state: Blue gradient background, moon emoji
   - [ ] Pulsing animation when active
   - [ ] "I Need Space" / "Ghost Mode Active" text
   - [ ] Click to toggle functionality

3. **Status Message**
   - [ ] Text below button
   - [ ] "Your partner sees a calm blue light" when active

4. **Partner Status Card**
   - [ ] Avatar circle (64x64px)
   - [ ] Blue glow if partner is in ghost mode
   - [ ] Green glow if partner is available
   - [ ] Status text
   - [ ] Message ("Give them time" or "Ready to connect")

**Complete Code:** See `MIZI_INSTRUCTIONS.md` lines 122-200

---

### File 3: Conflict Chat View Polish ⭐⭐ SHOULD HAVE
**Path:** `resources/views/livewire/features/conflict-chat.blade.php`  
**Status:** ⚠️ EXISTS BUT NEEDS STYLING  
**Time:** 30 minutes

#### What to Improve:
1. **Chat Container**
   - [ ] Max width container
   - [ ] Scrollable area
   - [ ] Gradient background

2. **Message Bubbles**
   - [ ] Left-aligned for "me" (purple bubble)
   - [ ] Right-aligned for "partner" (gray bubble)
   - [ ] Rounded corners
   - [ ] Padding and spacing
   - [ ] Timestamp below each

3. **AI Advice Card**
   - [ ] Purple gradient background
   - [ ] Sparkle icon (✨)
   - [ ] "Aura says:" label
   - [ ] Advice text (white)
   - [ ] Fade-in animation

4. **Health Bar**
   - [ ] Full-width bar
   - [ ] Green to red gradient based on value
   - [ ] Percentage text
   - [ ] Smooth transition animation
   - [ ] Heart icon

5. **Input Area**
   - [ ] Text input (full width)
   - [ ] Send button (purple)
   - [ ] Disabled state when locked
   - [ ] Lock icon when disabled

6. **Empathy Button**
   - [ ] Large button below chat
   - [ ] Heart icon
   - [ ] "Offer Empathy" text
   - [ ] Pink/purple gradient
   - [ ] Hover effect

**Reference:** Check Zarif's existing file and add these styles

---

### File 4: Navigation Menu Enhancement ⭐ NICE TO HAVE
**Path:** `resources/views/layouts/app.blade.php`  
**Status:** ⚠️ EXISTS, NEEDS ENHANCEMENT  
**Time:** 15 minutes

#### What to Add to Header:
1. **Left Side (Logo Area)**
   - [ ] "US" logo (keep existing)
   - [ ] Make it link to dashboard

2. **Center (Quick Access)**
   - [ ] Vault icon button (🔒)
   - [ ] Space icon button (🌙)
   - [ ] Chat icon button (💬)
   - [ ] Each links to respective route
   - [ ] Hover effects

3. **Right Side (User Info)**
   - [ ] XP counter badge
     - [ ] Purple background
     - [ ] Current XP number
     - [ ] "XP" label
   - [ ] Level badge
     - [ ] Gold border
     - [ ] Level number
     - [ ] Level name tooltip
   - [ ] User avatar (existing)
   - [ ] Dropdown menu (existing)

**Find:** Look for `<nav>` tag in app.blade.php

---

### File 5: Custom CSS Animations 🎨
**Path:** `resources/css/app.css`  
**Status:** ⚠️ EXISTS, ADD TO IT  
**Time:** 10 minutes

#### Animations to Add:
```css
/* Vault hover effect */
.vault-item-container:hover img {
    transform: scale(1.05);
}

/* Ghost mode pulse */
@keyframes ghost-pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}

.ghost-active {
    animation: ghost-pulse 2s infinite;
}

/* Health bar transition */
.health-bar {
    transition: width 0.5s ease-in-out;
}

/* Message fade in */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.message-bubble {
    animation: fadeIn 0.3s ease-out;
}
```

---

## 📊 COMPLETE CHECKLIST SUMMARY

### Must Build (Demo Critical):
- [ ] **Vault UI** - 45 min - NEW FILE
- [ ] **Space UI** - 30 min - NEW FILE

### Should Build (Polish):
- [ ] **Conflict Chat Styling** - 30 min - EDIT EXISTING
- [ ] **Navigation Enhancement** - 15 min - EDIT EXISTING
- [ ] **Custom CSS** - 10 min - ADD TO EXISTING

**Total Time:** 2 hours 10 minutes

---

## 🚫 FILES YOU MUST NOT TOUCH

**Backend (Fardeen's Territory):**
- ❌ `routes/web.php`
- ❌ `routes/features.php`
- ❌ `app/Services/**/*`
- ❌ `app/Models/**/*`
- ❌ `app/Livewire/Features/DailyCheckIn.php`
- ❌ `database/migrations/**/*`

**Frontend (Already Done by Fardeen):**
- ❌ `resources/views/welcome.blade.php`
- ❌ `resources/views/dashboard.blade.php`
- ❌ `resources/views/livewire/features/daily-check-in.blade.php`

---

## ✅ WORKFLOW

### Step 1: Create Your Branch
```bash
git checkout -b mizi-ui
```

### Step 2: Create Files in Order
1. Create `vault.blade.php` (NEW)
2. Create `space.blade.php` (NEW)
3. Edit `conflict-chat.blade.php` (EXISTING)
4. Edit `app.blade.php` navigation (EXISTING)
5. Add to `app.css` (EXISTING)

### Step 3: Test Each Feature
```bash
# Visit these URLs to test:
http://localhost:8000/vault
http://localhost:8000/space
http://localhost:8000/conflict-chat
```

### Step 4: Commit
```bash
git add resources/views/livewire/features/vault.blade.php
git commit -m "feat(ui): add Vault photo gallery"

git add resources/views/livewire/features/space.blade.php
git commit -m "feat(ui): add Space ghost mode interface"

# etc...
```

### Step 5: Push Your Branch
```bash
git push origin mizi-ui
```

**DO NOT MERGE TO MAIN YOURSELF - Let Fardeen handle merging**

---

## 🎨 DESIGN SYSTEM (Use These)

### Colors:
- Purple: `bg-purple-600`, `text-purple-600`
- Blue: `bg-blue-400`, `text-blue-400`
- Pink: `bg-pink-500`, `text-pink-500`
- Gray: `bg-secondary-100`, `text-secondary-600`

### Components:
```blade
<x-ui.card title="Title">Content</x-ui.card>
<x-ui.button variant="primary">Click</x-ui.button>
```

### Icons (Heroicons):
```blade
<x-heroicon-s-heart class="w-6 h-6 text-pink-500" />
<x-heroicon-s-lock-closed class="w-6 h-6 text-purple-600" />
<x-heroicon-s-moon class="w-6 h-6 text-blue-400" />
```

### Animations:
- `animate-pulse` - Pulsing effect
- `transition-all duration-500` - Smooth transitions
- `blur-xl` → `blur-none` - Blur effect
- `hover:scale-110` - Scale on hover

---

## 📝 COMPLETE FILE LIST

**Files Mizi Will Create/Edit:**
1. ✅ `resources/views/livewire/features/vault.blade.php` (NEW)
2. ✅ `resources/views/livewire/features/space.blade.php` (NEW)
3. ✅ `resources/views/livewire/features/conflict-chat.blade.php` (EDIT)
4. ✅ `resources/views/layouts/app.blade.php` (EDIT - nav only)
5. ✅ `resources/css/app.css` (ADD animations)

**Total:** 5 files (2 new, 3 edits)

---

## 🏆 SUCCESS CRITERIA

### Vault UI:
- [ ] Can upload a photo
- [ ] Photos appear blurred
- [ ] Hover removes blur smoothly
- [ ] Empty state shows when no photos
- [ ] Responsive on mobile

### Space UI:
- [ ] Toggle button works
- [ ] Blue glow appears when active
- [ ] Partner status shows correctly
- [ ] Animations are smooth
- [ ] Dark theme looks good

### Conflict Chat:
- [ ] Messages align correctly (left/right)
- [ ] AI advice card looks good
- [ ] Health bar animates
- [ ] Input locks after sending
- [ ] Empathy button is prominent

### Navigation:
- [ ] Quick access icons visible
- [ ] XP counter shows in header
- [ ] Level badge displays
- [ ] All links work

---

**This is EVERYTHING. No more, no less. Build these 5 files and we're 100% demo-ready!**
