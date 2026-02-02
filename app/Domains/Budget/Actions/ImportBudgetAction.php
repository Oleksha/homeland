<?php

namespace App\Domains\Budget\Actions;

use App\Support\Action;
use AsAction;
use BudgetExcelImport;
use Maatwebsite\Excel\Facades\Excel;
use UploadedFile;

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
