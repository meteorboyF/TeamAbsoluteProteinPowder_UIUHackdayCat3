<?php

namespace App\Services\Core;

use App\Models\Page;
use Illuminate\Support\Str;

class CmsService extends BaseService
{
    /**
     * Create or update a page.
     */
    public function savePage(array $data, ?Page $page = null): Page
    {
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        if ($page) {
            $page->update($data);
            return $page;
        }

        return Page::create($data);
    }

    /**
     * Find page by slug.
     */
    public function findBySlug(string $slug): ?Page
    {
        return Page::where('slug', $slug)->published()->first();
    }
}
