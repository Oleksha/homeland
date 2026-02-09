<?php

namespace App\Http\Controllers;

use App\Domains\Category\Actions\{
    ForceDeleteCategoryAction,
    StoreCategoryAction,
    UpdateCategoryAction,
    DeleteCategoryAction,
    RestoreCategoryAction};
use App\Domains\Category\DTO\CategoryDTO;
use App\Domains\Category\Models\Category;
use App\Http\Requests\{
    StoreCategoryRequest,
    UpdateCategoryRequest
};

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent')
            ->orderBy('name')
            ->get();

        return view('dictionaries.categories.index', [
            'categories' => $categories,
            'breadcrumbs' => [
                ['title' => 'Справочники', 'url' => route('directories.index')],
                ['title' => 'Категории номенклатуры'],
            ],
        ]);
    }

    public function create()
    {
        return view('dictionaries.categories.form', [
            'categories' => Category::orderBy('name')->get(),
            'breadcrumbs' => [
                ['title' => 'Справочники', 'url' => route('directories.index')],
                ['title' => 'Категории номенклатуры', 'url' => route('categories.index')],
                ['title' => 'Добавление'],
            ],
        ]);
    }

    public function store(
        StoreCategoryRequest $request,
        StoreCategoryAction $action
    ) {
        $action->execute(CategoryDTO::fromRequest($request));

        return redirect()
            ->route('categories.index')
            ->with('success','Категория добавлена.');
    }

    public function edit(Category $category)
    {
        return view('dictionaries.categories.form', [
            'category' => $category,
            'categories' => Category::where('id', '!=', $category->id)->get(),
            'breadcrumbs' => [
                ['title' => 'Справочники', 'url' => route('directories.index')],
                ['title' => 'Категории номенклатуры', 'url' => route('categories.index')],
                ['title' => 'Редактирование'],
            ],
        ]);
    }

    public function update(
        UpdateCategoryRequest $request,
        Category $category,
        UpdateCategoryAction $action
    ) {
        $action->execute($category, CategoryDTO::fromRequest($request));

        return redirect()
            ->route('categories.index')
            ->with('success','Категория изменена.');
    }

    public function destroy(
        Category $category,
        DeleteCategoryAction $action
    ) {
        $action->execute($category);

        return redirect()
            ->route('categories.index')
            ->with('success','Категория перемещена в архив.');
    }

    public function archive()
    {
        return view('dictionaries.categories.archive', [
            'categories' => Category::onlyTrashed()->orderBy('name')->get(),
            'breadcrumbs' => [
                ['title' => 'Справочники', 'url' => route('directories.index')],
                ['title' => 'Архив категорий номенклатуры'],
            ],
        ]);
    }

    public function restore(
        int $id,
        RestoreCategoryAction $action
    ) {
        $action->execute($id);

        return redirect()
            ->route('categories.index')
            ->with('success','Категория восстановлена.');
    }

    public function forceDelete(int $id)
    {
        ForceDeleteCategoryAction::run($id);

        return redirect()->route('categories.index')
            ->with('success','Категория удалена навсегда.');
    }
}
