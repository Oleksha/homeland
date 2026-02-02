<?php

namespace App\Http\Controllers;

use App\Domains\Budget\Actions\ImportBudgetAction;
use App\Http\Requests\BudgetImportRequest;

final class ImportBudgetController
{
    public function __invoke(BudgetImportRequest $request)
    {
        ImportBudgetAction::run($request->file('file'));

        return back()->with('success', 'Импорт запущен');
    }
}
