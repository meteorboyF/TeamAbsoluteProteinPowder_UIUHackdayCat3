# 🚀 Team Instructions - "Project US"

**Current State:** UI Rebrand Complete (Phase 8-11).
**Active Agent:** Mizi (The Skin)
**Status:** Handoff Mode

---

## 🎨 Update from Mizi (The Skin)
I have essentially rewritten the frontend face of the application.
-   **Landing Page**: Deep Space/Glass aesthetic with "Heartbeat" animations.
-   **Auth**: Login/Register pages now match the landing page (No sidebar).
-   **Resonance Chamber**: The Conflict Chat is now a "Dark Glass" sanctuary with a glowing health bar and "Listening Mode" UI.

**CRITICAL**: The UI is ready, but it is currently mocking data. It needs muscles (Zarif) and brains (Fardeen).

---

## 💪 Instructions for Zarif (The Muscles - Backend)

### 1. Resonance Chamber Wiring
*   **File**: `app/Livewire/Features/ConflictChat.php`
*   **View**: `resources/views/livewire/features/conflict-chat.blade.php`
*   **Task**:
    -   Connect the **Health Bar** (`$health` variable) to the real `RelationshipHealth` model.
    -   Implement the logic for **Listening Mode** (`$isLocked`). This should toggle to `true` when the other user is typing long paragraphs or when AI detects high tension.
    -   Ensure `sendMessage` accurately decrements/increments health based on basic sentiment (or simpler logic for now).

### 2. The Vault Backend
*   **File**: `app/Livewire/Features/Vault.php` (You may need to create/update this)
*   **Task**:
    -   The "Rub-to-Reveal" UI is ready in `vault.blade.php`.
    -   Implement the standard **Encryption** logic for storing these images.

---

## 🧠 Instructions for Fardeen (The Brain - AI)

### 1. Aura Intevention
*   **Context**: The "Resonance Chamber" (`ConflictChat`) now has a slot for `$auraAdvice`.
*   **Task**:
    -   Hook up your **Gemini Sentiment Analysis** to the chat stream.
    -   When tension is high (>80%), populate the `$auraAdvice` variable with a de-escalation prompt.
    -   **Trigger**: If the User writes a message with "Accusatory Language" (You always, You never), trigger the **Listening Mode** lock and force them to rephrase.

### 2. The Garden Logic
*   **Context**: `dashboard.blade.php` shows a plant growing.
*   **Task**:
    -   Define the **XP Algorithm** based on positive interactions.
    -   Pass the current growth stage to the view so the icon changes (Seed -> Sprout -> Bloom).

---

## ⚠️ General Notes
-   **Layouts**: `Login` and `Register` now use `layouts.guest`. Do not revert them to `layouts.app` or the sidebar will break the immersion.
-   **Icons**: We are using standard SVGs or Heroicons.
