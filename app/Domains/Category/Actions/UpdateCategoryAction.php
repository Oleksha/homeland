<?php

namespace App\Domains\Category\Actions;

use App\Domains\Category\DTO\CategoryDTO;
use App\Domains\Category\Models\Category;

class UpdateCategoryAction
{
    public function execute(Category $category, CategoryDTO $dto): Category
    {
        $category->update($dto->toArray());

        return $category;
    }
}
