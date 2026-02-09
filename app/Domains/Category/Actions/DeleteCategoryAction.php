<?php

namespace App\Domains\Category\Actions;

use App\Domains\Category\Models\Category;

class DeleteCategoryAction
{
    public function execute(Category $category): void
    {
        $category->delete();
    }
}
