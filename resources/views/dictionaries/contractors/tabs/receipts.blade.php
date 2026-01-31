{{-- Поступления --}}
<div class="tab-pane fade show active" id="receipts" role="tabpanel">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="mb-0">Поступления по контрагенту</h6>

        <a
            href="{{ route('receipts.create', ['contractor_id' => $contractor->id]) }}"
            class="btn btn-sm btn-primary"
        >
            + Новое поступление
        </a>
    </div>

    @if($receipts->isEmpty())
        <div class="text-muted">
            Поступлений пока нет
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-sm table-striped align-middle">
                <thead>
                <tr>
                    <th>Дата</th>
                    <th>Номер</th>
                    <th>Тип</th>
                    <th class="text-end">Сумма</th>
                    <th class="text-end">НДС</th>
                    <th class="text-center">Статус</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($receipts as $receipt)
                    <tr>
                        <td>{{ $receipt->date->format('d.m.Y') }}</td>
                        <td>{{ $receipt->number }}</td>
                        <td>{{ $receipt->type->label() }}</td>
                        <td class="text-end">
                            {{ number_format($receipt->total_amount, 2, ',', ' ') }}
                        </td>
                        <td class="text-end">
                            {{ number_format($receipt->total_vat, 2, ',', ' ') }}
                        </td>
                        <td class="text-center">
                            <span class="badge {{ $receipt->status ? 'bg-success' : 'bg-secondary' }}">
                                {{ $receipt->status ? 'Активно' : 'Не активно' }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a
                                href="{{ route('receipts.show', $receipt) }}"
                                class="btn btn-sm btn-outline-secondary"
                            >
                                Просмотр
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>
