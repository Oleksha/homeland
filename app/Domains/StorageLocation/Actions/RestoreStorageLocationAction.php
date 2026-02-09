<?php

namespace App\Domains\StorageLocation\Actions;

use App\Domains\StorageLocation\Models\StorageLocation;

class RestoreStorageLocationAction
{
    public function execute(int $id): void
    {
        StorageLocation::withTrashed()
            ->findOrFail($id)
            ->restore();
    }
}
