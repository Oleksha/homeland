<?php

namespace App\Http\Requests;

use App\Domains\Budget\DTO\BudgetIndexFilterDTO;
use App\Domains\Budget\Enums\BudgetStatus;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BudgetIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'period' => ['nullable', 'date'],
            'status' => ['nullable', Rule::in(BudgetStatus::values())],
            'archived' => ['nullable', 'boolean'],
        ];
    }

    public function toDto(): BudgetIndexFilterDTO
    {
        return new BudgetIndexFilterDTO(
            period: $this->period
                ? CarbonImmutable::parse($this->period)
                : null,

            status: $this->status
                ? BudgetStatus::from($this->status)
                : null,

            archived: (bool) $this->boolean('archived'),
        );
    }
}
