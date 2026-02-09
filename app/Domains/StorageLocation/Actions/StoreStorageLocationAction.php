<?php

namespace App\Domains\StorageLocation\Actions;

use App\Domains\StorageLocation\DTO\StorageLocationDTO;
use App\Domains\StorageLocation\Models\StorageLocation;

class StoreStorageLocationAction
{
    public function execute(StorageLocationDTO $dto): StorageLocation
    {
        return StorageLocation::create($dto->toArray());
    }
}
