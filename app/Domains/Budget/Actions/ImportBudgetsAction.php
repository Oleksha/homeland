<?php

namespace App\Domains\Budget\Actions;

use App\Domains\Budget\Imports\BudgetXlsxImport;
use App\Support\Action;
use Illuminate\Http\UploadedFile;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

final class ImportBudgetsAction extends Action
{

    public function __invoke(UploadedFile $file): void
    {
        $import = new BudgetXlsxImport();

        Excel::import($import, $file);

        foreach ($import->rows() as $row) {
            try {
                CreateBudget::run(
                    $row->toBudgetData()
                );

            } catch (Throwable $e) {

                logger()->error('Ошибка импорта бюджета', [
                    'row' => $row->rowNumber,
                    'error' => $e->getMessage()
                ]);
            }
        }
    }
}
