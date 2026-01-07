# 🛡️ TEAM ABSOLUTE PROTEIN POWDER - UI HANDOFF GUIDE

**FROM:** Mizi (The Skin)
**TO:** Fardeen (The Skeleton) & Zarif (The Muscles)

The UI System is live! Stop writing custom HTML. Use the shiny new "Lego Bricks" I built.

## ⚡ IMMEDIATE ACTION REQUIRED
1.  **Git Sync:** Run `git pull origin UI_Branch` (or main if merged).
2.  **Verify:** Visit `/components/design` to see the components in action.

---

## 💀 FOR FARDEEN (The Skeleton) - Core/Admin

You are building the Admin Panels, Logs, and Settings.
**Your Toolkit:**

### 1. Layouts
Extend the main layout for **ALL** your pages. It handles the sidebar and auth check automatically.
```html
<x-app-layout>
    <!-- Your content here -->
</x-app-layout>
```

### 2. Tables (For Logs & User Lists)
Don't build `<table>` tags manually. Use my component:
```html
<x-ui.table :headers="['User', 'Action', 'Time']">
    @foreach($logs as $log)
    <tr>
        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-secondary-900 sm:pl-6">{{ $log->user->name }}</td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-secondary-500">{{ $log->action }}</td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-secondary-500">{{ $log->created_at->diffForHumans() }}</td>
    </tr>
    @endforeach
</x-ui.table>
```

### 3. Cards (For Dashboard Widgets)
```html
<x-ui.card title="System Status">
    <p class="text-secondary-600">All systems operational.</p>
    <x-slot name="footer">
        Updated 5 mins ago
    </x-slot>
</x-ui.card>
```

---

## 💪 FOR ZARIF (The Muscles) - Features/Chat

You are building Chat, Feeds, and Uploads. You need interactivity.
**Your Toolkit:**

### 1. Modals (For Chat/Uploads)
Use the `open-modal` / `close-modal` dispatch events.
```html
<!-- Trigger -->
<x-ui.button @click="$dispatch('open-modal', 'upload-modal')">
    Upload File
</x-ui.button>

<!-- Modal -->
<x-ui.modal name="upload-modal" title="Upload Evidence">
    <x-ui.input type="file" name="evidence" />
    <x-slot name="footer">
        <x-ui.button variant="primary" wire:click="upload">Upload</x-ui.button>
        <x-ui.button variant="secondary" @click="$dispatch('close-modal', 'upload-modal')">Cancel</x-ui.button>
    </x-slot>
</x-ui.modal>
```

### 2. Toasts (For "Message Sent")
Trigger toasts from Livewire or Alpine.
```html
<!-- From Alpine -->
<button @click="$dispatch('notify', { type: 'success', message: 'Message sent!' })">Send</button>

<!-- From Livewire (PHP) -->
$this->dispatch('notify', type: 'success', message: 'Message sent!');
```

### 3. Inputs (For Chat Box)
```html
<x-ui.input 
    label="Message" 
    placeholder="Type something benign..." 
    wire:model="message" 
    @keydown.enter="sendMessage"
/>
```

---

## 🎨 STYLING RULES (MIZI'S LAW)
1.  **Do NOT** write custom CSS classes if you can avoid it.
2.  **Do NOT** touch `tailwind.config.js` (Ask me first).
3.  **USE** `text-secondary-500` for muted text, `text-primary-600` for brand colors.

Go build something awesome.  
- **Mizi**
