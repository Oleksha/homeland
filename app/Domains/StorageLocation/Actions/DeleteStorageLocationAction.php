<?php

namespace App\Domains\StorageLocation\Actions;

use App\Domains\StorageLocation\Models\StorageLocation;

class DeleteStorageLocationAction
{
    public function execute(StorageLocation $location): void
    {
        $location->delete();
    }
}
