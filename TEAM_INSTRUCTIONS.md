# 🛡️ TEAM ABSOLUTE PROTEIN POWDER - UI HANDOFF GUIDE (v2)

**FROM:** Mizi (The Skin)
**TO:** Fardeen (The Skeleton) & Zarif (The Muscles)

**STATUS: PHASE 2 COMPLETE**
- ✅ **Auth Pages** (Login/Register) are styled.
- ✅ **Dashboard** is styled (Grid layout + Cards).
- ✅ **Admin Logs** are styled (Table + Stats).
- ✅ **Notifications** are styled (Dropdown).

---

## ⚡ IMMEDIATE ACTION REQUIRED
1.  **Git Sync:** `git checkout main` -> `git pull` -> `git merge UI_Branch` (if not already merged).
2.  **Verify:** Check `/dashboard` and `/admin/logs` to see the new themes.

---

## 💀 FOR FARDEEN (The Skeleton) - Core/Admin

### 1. New Pattern: Admin Tables
Look at `resources/views/livewire/admin/log-viewer.blade.php`.
I have set up the standard for displaying data:
- Use `<x-ui.card>` for stats at the top.
- Use `<x-ui.table>` for the main list.
- Use `wire:poll` only if you really need real-time data.

### 2. General Page Structure
Copy this structure for any new Admin Page:
```html
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-bold font-display text-secondary-900">Page Title</h2>
        <x-ui.button>Action</x-ui.button>
    </div>
    
    <x-ui.card>
        <!-- Content -->
    </x-ui.card>
</div>
```

---

## 💪 FOR ZARIF (The Muscles) - Features/Chat

### 1. Notifications are LIVE
I styled `livewire/core/notifications.blade.php`.
- You can trigger a notification using `$dispatch('notify', ...)` as before.
- The dropdown handles unread states visually now.

### 2. Chat UI Tips
For the Chat interface you are building:
- Use `<x-ui.card>` for the main chat window.
- Use `<x-ui.input>` with an icon for the message bar.
- Use `<x-ui.button variant="ghost">` for attachment icons to keep it clean.

---

## 🎨 REMINDERS (MIZI'S LAW)
1.  **Don't break the layout:** Always wrap your pages in `<x-app-layout>`.
2.  **Don't write CSS:** If you need a margin, use `class="mt-4"`. If you need a color, use `text-secondary-500`.

**-- Mizi**
