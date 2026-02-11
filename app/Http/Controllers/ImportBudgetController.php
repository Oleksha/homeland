<?php

namespace App\Http\Controllers;

use App\Http\Requests\BudgetImportRequest;
use App\Domains\Budget\Actions\ImportBudgetsAction;

class ImportBudgetController extends Controller
{
    public function __invoke(BudgetImportRequest $request)
    {
        ImportBudgetsAction::run(
            $request->file('file')
        );

        return back()->with('success', 'Импорт выполнен');
    }
}
