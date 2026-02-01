<?php

namespace App\Domains\Budget\Actions;

final class ImportResult
{
    public int $success = 0;
    public array $errors = [];
}
