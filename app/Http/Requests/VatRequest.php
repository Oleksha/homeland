<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VatRequest extends FormRequest
{
    public function authorize(): bool
    {
        // авторизации пока нет
        return true;
    }

    public function rules(): array
    {
        return [
            'name'       => ['required', 'string', 'max:255'],
            'rate'       => ['required', 'numeric', 'min:0', 'max:100'],
            'code'       => ['nullable', 'string', 'max:50'],
            'is_active'  => ['sometimes', 'boolean'],
            'is_default' => ['sometimes', 'boolean'],
        ];
    }

    /**
     * Нормализуем данные сразу здесь
     */
    public function payload(): array
    {
        return [
            'name'       => $this->input('name'),
            'rate'       => (float) $this->input('rate'),
            'code'       => $this->input('code'),
            'is_active'  => $this->boolean('is_active'),
            'is_default' => $this->boolean('is_default'),
        ];
    }
}
