<?php

namespace App\Domains\Budget\Actions;

use App\Support\Action;
use AsAction;
use BudgetExcelImport;
use Illuminate\Http\UploadedFile;
use Maatwebsite\Excel\Facades\Excel;

final class ImportBudgetAction extends Action
{
    use AsAction;

    public function handle(UploadedFile $file): void
    {
        Excel::import(
            new BudgetExcelImport(),
            $file
        );
    }
}
