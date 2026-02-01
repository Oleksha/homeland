<?php

namespace App\Domains\Budget\Actions;

use App\Domains\Budget\DTO\BudgetImportMapper;
use App\Domains\Budget\Services\BudgetImportValidator;

final readonly class ImportBudgetsAction
{
    public function __construct(
        private BudgetImportValidator $validator,
        private BudgetImportMapper $mapper,
    ) {}

    public function run(iterable $rows): ImportResult
    {
        $result = new ImportResult();

        foreach ($rows as $row) {
            try {
                $this->validator->validate($row);

                $data = $this->mapper->map($row);

                CreateBudget::run($data);

                $result->success++;
            } catch (\Throwable $e) {
                $result->errors[] = $e->getMessage();
            }
        }

        return $result;
    }
}
