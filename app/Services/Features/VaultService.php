<?php

namespace App\Services\Features;

use App\Models\VaultItem;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

class VaultService
{
    /**
     * Upload a file to the vault with optional time-lock
     */
    public function uploadItem(int $userId, UploadedFile $file, ?string $unlockDate = null, ?int $unlockLevel = null): VaultItem
    {
        // Store file in private storage
        $path = $file->store('vault', 'private');

        return VaultItem::create([
            'user_id' => $userId,
            'type' => $this->determineType($file),
            'file_path' => $path,
            'unlock_at' => $unlockDate ? Carbon::parse($unlockDate) : null,
            'unlock_level' => $unlockLevel,
            'is_hidden' => true, // Default to hidden (rub-to-reveal)
        ]);
    }

    /**
     * Store a text secret (encrypted)
     */
    public function storeSecret(int $userId, string $content, ?string $unlockDate = null, ?int $unlockLevel = null): VaultItem
    {
        $encryptedContent = Crypt::encryptString($content);

        // Save as a text file in storage to keep uniformity with file_path
        $fileName = 'secret_' . time() . '.txt';
        $path = 'vault/' . $fileName;
        Storage::disk('private')->put($path, $encryptedContent);

        return VaultItem::create([
            'user_id' => $userId,
            'type' => 'secret',
            'file_path' => $path,
            'unlock_at' => $unlockDate ? Carbon::parse($unlockDate) : null,
            'unlock_level' => $unlockLevel,
            'is_hidden' => false, // Secrets might not need rub-to-reveal, just lock
        ]);
    }

    /**
     * Get all accessible (unlocked) items for a user
     */
    public function getAccessibleItems(int $userId): array
    {
        return VaultItem::where('user_id', $userId)
            ->where(function ($query) {
                $query->whereNull('unlock_at')
                    ->orWhere('unlock_at', '<=', Carbon::now());
            })
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'type' => $item->type,
                    'url' => $this->getFileUrl($item),
                    'is_hidden' => $item->is_hidden,
                    'created_at' => $item->created_at,
                ];
            })
            ->toArray();
    }

    /**
     * Check if a specific item is unlocked
     */
    public function checkUnlockStatus(int $itemId): bool
    {
        $item = VaultItem::find($itemId);

        if (!$item) {
            return false;
        }

        // Check time lock
        if ($item->unlock_at && $item->unlock_at->isFuture()) {
            return false;
        }

        // Check level lock
        if ($item->unlock_level) {
            $userLevel = app(GamificationService::class)->getUserLevel($item->user_id);
            if ($userLevel < $item->unlock_level) {
                return false;
            }
        }

        return true;
    }

    /**
     * Reveal a hidden item (remove blur)
     */
    public function revealItem(int $itemId): bool
    {
        $item = VaultItem::find($itemId);

        if (!$item || !$item->isUnlocked()) {
            return false;
        }

        $item->update(['is_hidden' => false]);
        return true;
    }

    /**
     * Get file URL for display
     */
    /**
     * Get file URL or Content for display
     */
    public function getItemContent(VaultItem $item): string|array
    {
        if ($item->type === 'secret') {
            try {
                $encrypted = Storage::disk('private')->get($item->file_path);
                return ['text' => Crypt::decryptString($encrypted)];
            } catch (\Exception $e) {
                return ['error' => 'Could not decrypt secret.'];
            }
        }

        return ['url' => Storage::disk('private')->url($item->file_path)];
    }

    private function getFileUrl(VaultItem $item): string
    {
        return Storage::disk('private')->url($item->file_path);
    }

    /**
     * Determine file type from upload
     */
    private function determineType(UploadedFile $file): string
    {
        $mimeType = $file->getMimeType();

        if (str_starts_with($mimeType, 'image/')) {
            return 'photo';
        }

        return 'note';
    }
}
