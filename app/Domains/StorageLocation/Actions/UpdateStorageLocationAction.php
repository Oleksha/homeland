<?php

namespace App\Domains\StorageLocation\Actions;

use App\Domains\StorageLocation\DTO\StorageLocationDTO;
use App\Domains\StorageLocation\Models\StorageLocation;

class UpdateStorageLocationAction
{
    public function execute(StorageLocation $location, StorageLocationDTO $dto): StorageLocation
    {
        $location->update($dto->toArray());
        return $location;
    }
}
