<?php

namespace App\Domains\Category\Actions;

use App\Domains\Category\DTO\CategoryDTO;
use App\Domains\Category\Models\Category;

class StoreCategoryAction
{
    public function execute(CategoryDTO $dto): Category
    {
        return Category::create($dto->toArray());
    }
}
