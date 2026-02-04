{{-- Разрешения на оплату --}}
<div
    class="tab-pane fade"
    id="payment-authorizations"
    role="tabpanel"
    aria-labelledby="pa-tab"
>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="mb-0">Действующие разрешения на оплату</h6>

        <a
            href="{{ route('payment-authorizations.create', ['contractor_id' => $contractor->id]) }}"
            class="btn btn-sm btn-success mb-2">
            + Создать разрешение
        </a>
    </div>

    @if($paymentAuthorizations->isEmpty())
        <div class="text-muted">
            Нет действующих разрешений
        </div>
    @else

        <div class="table-responsive">
            <table class="table table-sm table-striped align-middle">

                <thead>
                <tr>
                    <th>Номер</th>
                    <th>Статья расхода</th>
                    <th>Период действия</th>
                    <th>Отсрочка</th>
                    <th class="text-end">Сумма</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>

                @foreach($paymentAuthorizations as $pa)
                    <tr>
                        <td>{{ $pa->number }}</td>

                        <td>
                            {{ $pa->expenseItem?->name }}
                        </td>

                        <td>
                            {{ optional($pa->date_start)->format('d.m.Y') }}
                            —
                            {{ optional($pa->date_end)->format('d.m.Y') ?? '∞' }}
                        </td>

                        <td>
                            {{ $pa->delay }} дн.
                        </td>

                        <td class="text-end">
                            {{ number_format($pa->amount, 2, ',', ' ') }}
                        </td>

                        <td class="text-end">
                            <a href="{{ route('payment-authorizations.show', $pa) }}"
                               class="btn btn-sm btn-outline-primary">
                                Открыть
                            </a>
                        </td>
                    </tr>
                @endforeach

                </tbody>

            </table>
        </div>

    @endif

</div>
