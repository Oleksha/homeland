<?php

namespace App\Domains\Contractor\DTO;

class ContractorData
{
    public string $name;
    public ?string $code;
    public int $type_id;
    public bool $is_supplier;
    public ?string $inn;
    public ?string $kpp;
    public ?string $address;
    public ?string $phone;
    public ?string $email;
    public ?int $delay;
    public ?int $vat_id;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->code = $data['code'] ?? null;
        $this->type_id = (int) $data['type_id'];
        $this->is_supplier = (bool) ($data['is_supplier'] ?? false);
        $this->inn = $data['inn'] ?? null;
        $this->kpp = $data['kpp'] ?? null;
        $this->address = $data['address'] ?? null;
        $this->phone = $data['phone'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->delay = isset($data['delay']) ? (int) $data['delay'] : null;
        $this->vat_id = isset($data['vat_id']) ? (int) $data['vat_id'] : null;
    }

    /**
     * Создание DTO из массива (например, $request->validated())
     */
    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    /**
     * Преобразовать DTO в массив для передачи в Model::create/update
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'code' => $this->code,
            'type_id' => $this->type_id,
            'is_supplier' => $this->is_supplier,
            'inn' => $this->inn,
            'kpp' => $this->kpp,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'delay' => $this->delay,
            'vat_id' => $this->vat_id,
        ];
    }
}
