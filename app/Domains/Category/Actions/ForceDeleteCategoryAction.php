<?php

namespace App\Domains\Category\Actions;

use App\Domains\Category\Models\Category;

class ForceDeleteCategoryAction
{
    public static function run(int $id): void
    {
        Category::withTrashed()
            ->findOrFail($id)
            ->forceDelete();
    }
}
