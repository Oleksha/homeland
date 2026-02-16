<?php

namespace App\Http\Requests;

use App\Domains\Payment\DTO\PaymentRequestIndexFilterDTO;
use App\Domains\Payment\Enums\PaymentRequestStatus;
use Illuminate\Foundation\Http\FormRequest;
use Carbon\CarbonImmutable;

class PaymentRequestIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'period'   => ['nullable', 'date_format:Y-m'],
            'status'   => ['nullable', 'in:' . implode(',', PaymentRequestStatus::values())],
            'archived' => ['nullable', 'boolean'],
        ];
    }

    public function toDto(): PaymentRequestIndexFilterDTO
    {
        $period = $this->input('period')
            ? CarbonImmutable::createFromFormat('Y-m', $this->input('period'))->startOfMonth()
            : null;

        return new PaymentRequestIndexFilterDTO(
            period: $period,
            status: $this->input('status')
                ? PaymentRequestStatus::from($this->input('status'))
                : null,
            archived: $this->boolean('archived')
        );
    }
}
