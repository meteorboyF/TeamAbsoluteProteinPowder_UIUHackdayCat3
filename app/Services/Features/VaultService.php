<?php

namespace App\Services\Features;

use App\Models\VaultItem;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class VaultService
{
    /**
     * Upload a file to the vault with optional time-lock
     */
    public function uploadItem(int $userId, UploadedFile $file, ?string $unlockDate = null): VaultItem
    {
        // Store file in private storage
        $path = $file->store('vault', 'private');

        return VaultItem::create([
            'user_id' => $userId,
            'type' => $this->determineType($file),
            'file_path' => $path,
            'unlock_at' => $unlockDate ? Carbon::parse($unlockDate) : null,
            'is_hidden' => true, // Default to hidden (rub-to-reveal)
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

        return $item->isUnlocked();
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
