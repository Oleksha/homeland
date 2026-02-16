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
            'period' => ['nullable', 'date_format:Y-m'],
            'status' => ['nullable', Rule::in(BudgetStatus::values())],
            'archived' => ['nullable', 'boolean'],
        ];
    }

    public function toDto(): BudgetIndexFilterDTO
    {
        $validated = $this->validated();

        if (!empty($validated['period'])) {
            session(['budget_period' => $validated['period']]);
        }

        $period = $validated['period']
            ?? session('budget_period')
            ?? now()->format('Y-m');

        return new BudgetIndexFilterDTO(
            period: CarbonImmutable::createFromFormat('Y-m', $period)
                ->startOfMonth(),

            status: isset($validated['status'])
                ? BudgetStatus::from($validated['status'])
                : null,

            archived: (bool)($validated['archived'] ?? false),
        );
    }
}
