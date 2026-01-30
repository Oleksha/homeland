<?php

namespace App\Services\Vat;

use App\Domains\Vat\DTO\VatData;
use App\Domains\Vat\Models\Vat;
use Illuminate\Support\Facades\DB;
use RuntimeException;
use Throwable;

class VatService
{
    public function getActive(): Vat|array
    {
        return Vat::active()->orderBy('rate')->get();
    }

    public function getDefault(): Vat
    {
        return Vat::default()->first()
            ?? throw new RuntimeException('Ставка НДС по умолчанию не определена.');
    }

    public function find(int $id): Vat
    {
        return Vat::active()->findOrFail($id);
    }

    /**
     * @throws Throwable
     */
    public function store(VatData $dto): Vat
    {
        return DB::transaction(function () use ($dto) {
            if ($dto->isDefault) {
                $this->resetDefault();
            }

            return Vat::create($dto->toArray());
        });
    }

    /**
     * @throws Throwable
     */
    public function update(Vat $vat, VatData $dto): Vat
    {
        return DB::transaction(function () use ($vat, $dto) {
            if ($dto->isDefault) {
                $this->resetDefault($vat->id);
            }

            $vat->update($dto->toArray());

            return $vat;
        });
    }

    public function delete(Vat $vat): void
    {
        if ($vat->is_default) {
            throw new RuntimeException('Нельзя удалить НДС по умолчанию');
        }

        $vat->delete();
    }

    private function resetDefault(?int $exceptId = null): void
    {
        Vat::where('is_default', true)
            ->when($exceptId, fn ($q) => $q->where('id', '!=', $exceptId))
            ->update(['is_default' => false]);
    }

    private function normalize(array $data): array
    {
        return array_merge([
            'is_active'  => false,
            'is_default' => false,
        ], $data);
    }
}
