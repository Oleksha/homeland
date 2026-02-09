<?php

namespace App\Domains\Category\Actions;

use App\Domains\Category\Models\Category;

class RestoreCategoryAction
{
    public function execute(int $id): void
    {
        Category::withTrashed()
            ->findOrFail($id)
            ->restore();
    }
}
