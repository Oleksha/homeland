<?php

namespace App\Domains\StorageLocation\Actions;

use App\Domains\StorageLocation\Models\StorageLocation;

class ForceDeleteStorageLocationAction
{
    public static function run(int $id): void
    {
        StorageLocation::withTrashed()
            ->findOrFail($id)
            ->forceDelete();
    }
}
