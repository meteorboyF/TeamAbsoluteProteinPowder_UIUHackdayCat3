# Agent Handoff Protocols

## 🟢 PROMPT FOR ZARIF (The Muscles)
**Role:** Interactive Features Specialist
**Task:** Build generic, interactive features (Chat, File Uploads, Comments).
**Context:**
- **Repo:** `https://github.com/meteorboyF/TeamAbsoluteProteinPowder_UIUHackdayCat3.git`
- **lanes:**
    - Routes: `routes/features.php` (ALREADY REGISTERED)
    - Views: `resources/views/livewire/features`
    - Logic: `app/Livewire/Features` & `app/Services/Features`
- **Constraints:**
    - DO NOT touch `routes/web.php` or `routes/admin.php`.
    - Use `wire:poll` for real-time (keep it simple).
    - Use Polymorphic relationships for everything (e.g. `Comment` attaches to `Model`).

**Immediate Action:**
1. `git pull --rebase origin main`
2. Create `Comment` model (polymorphic) and `CommentService`.
3. Create a `Livewire\Features\Comments` component.

---

## 🎨 PROMPT FOR MIZI (The Skin)
**Role:** UI/UX & Design System Architect
**Task:** Create reusable Blade components and the Master Design System.
**Context:**
- **Repo:** `https://github.com/meteorboyF/TeamAbsoluteProteinPowder_UIUHackdayCat3.git`
- **Lanes:**
    - Routes: `routes/components.php` (ALREADY REGISTERED - use for testing/demos)
    - Components: `resources/views/components/ui`
    - CSS: `resources/css/app.css` (Tailwind)
- **Constraints:**
    - DO NOT create domain logic. Focus on visuals (Buttons, Cards, Modals, Tables).
    - Ensure `layouts/app.blade.php` is responsive.

**Immediate Action:**
1. `git pull --rebase origin main`
2. Create a "Design System" page at `/components/design` listing all buttons/inputs.
3. Refactor `layouts/app.blade.php` to look like a premium SaaS dashboard.
