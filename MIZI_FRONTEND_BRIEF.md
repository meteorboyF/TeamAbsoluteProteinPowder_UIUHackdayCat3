# MIZI - Frontend Implementation Brief (Backend Integrated)

**Status:** Backend Services are 100% Ready.
**Goal:** Connect the "6 Wonders" backend logic to beautiful, animated UI components.
**Aesthetic:** Glassmorphism, Soft Gradients, "Premium" feel.

---

## 1. The Space (Ghost Mode) Update
**Route:** `/space`
**Backend Service:** `SpaceService`

### UI Specs:
*   **Active State (Ghost Mode ON):**
    *   Show a large, pulsing **Blue Orb** (breathing animation).
    *   **Countdown Timer:** "Space ends in 45m".
    *   **Respect Note:** "Partner is respecting your space. You will both earn +30 XP."
*   **Partner View:**
    *   If I am blocked, show a calm "Partner needs space" screen.
    *   **Disable Messaging:** Blur the chat input or replace it with a "Send Love (notify only)" button that doesn't ping them immediately.

### Backend Data:
*   `$space->activateGhostMode($userId)` -> Returns Status object.
*   `$space->checkPartnerStatus($userId)` -> Returns `['type' => 'ghost/online', 'message' => '...']`.

---

## 2. The Vault (Memories & Secrets) Update
**Route:** `/vault`
**Backend Service:** `VaultService`

### UI Specs:
*   **Tabs:** "Photos" | "Secrets" (New!)
*   **Secrets Tab:**
    *   Simple text area to write a secret.
    *   **Encryption Badge:** "End-to-End Encrypted" icon (Visual trust).
*   **Milestone Unlocks:**
    *   Display items that are locked by **Relationship Level**.
    *   *Visual:* a padlock icon with "Unlocks at Level 4".
    *   *Interaction:* If user clicks, shake the lock animation.

### Backend Data:
*   `$vault->storeSecret($id, $text)` -> Encrypts and saves.
*   `$vault->getAccessibleItems($id)` -> Returns items (auto-filters locked ones).

---

## 3. Resonance (Conflict Resolution Chat) - **NEW**
**Route:** `/conflict`
**Backend Service:** `ChatService`

### UI Specs:
*   **Vibe:** Darker mode, calm tones (Indigo/Slate).
*   **Slow Mode:**
    *   After sending a message, show a **2-minute countdown** on the input field.
    *   *Visual:* a "Cooling Down..." progress bar.
*   **Emotion Selector:**
    *   Before sending, user **MUST** tap an emotion chip: `[Hurt] [Confused] [Angry] [Sad]`.
    *   The selected emotion appears as a badge above their message bubble.
*   **Empathy Button:**
    *   A generic "Listen First" toggle.
    *   *Action:* Toggling ON disables my input and shows "I am listening...".
*   **Ask Aura (AI Mediator):**
    *   Sticky header button: "Ask Aura for Help".
    *   *Action:* Sends last 10 messages to backend `AuraService::analyzeConflict` and displays the AI's empathetic advice in a special gold bubble.

### Backend Data:
*   `$chat->sendMessage(..., $emotion)` -> Supports emotion tag.
*   `$chat->toggleEmpathyMode(...)` -> Switch state.
*   **Error Handling:** If sending too fast, backend throws "Slow mode active". Catch this and show a toast.

---

## 4. Daily Rituals & Aura
**Route:** `/dashboard` (Integration)
**Backend Service:** `AuraService`

### UI Specs:
*   **Aura Alignment Card:**
    *   Fetch alignment score: `$aura->getAuraAlignment($id)`.
    *   **Visual:** Two intersecting circles (Venn diagram style).
        *   100% Alignment: Circles perfectly overlap (Gold glow).
        *   0% Alignment: Circles far apart.
    *   **Text:** Display the AI message: "Your energies are complementary. Good time to talk."

---

## 5. AI Cupid (Gift & Dates)
**Route:** `/cupid` (Or Modal in Dashboard)
**Backend Service:** `AiCupidService`

### UI Specs:
*   **Two Sections:** "Smart Gifts" and "Date Ideas".
*   **Magic Button:** "Ask Cupid ✨" (Triggers API call).
*   **Loading State:** essential (Gemini takes 1-2s). Show heart loading animation.
*   **Result Cards:**
    *   Display suggestions in elegant, flip-card style.
    *   *Context:* "Because you are Level 4..."

### Backend Data:
*   `$cupid->getGiftSuggestions($id)` -> Returns array of strings.
*   `$cupid->getDateIdeas($id)` -> Returns array of strings.

---

## 6. The Garden (Gamification)
**Route:** Global / Header
**Backend Service:** `GamificationService`

### UI Specs:
*   **XP Bar:** Slim progress bar at top of dashboard.
*   **Level Badge:** "Level 3: Friends" (Click to see benefits).
*   **Garden State:** The background image of the dashboard should match:
    *   `withered` -> Dry grass background.
    *   `blooming` -> Lush flowers background.
    *   *(Get state via `$gamification->getGardenHealth($id)['state']`)*

