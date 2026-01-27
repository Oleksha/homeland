@extends('layouts.app')

@section('title', 'Поступление №' . $receipt->number)

@section('content')
    <div class="container mt-4">

        {{-- Заголовок --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0">
                    Поступление №{{ $receipt->number }}
                </h4>
                <small class="text-muted">
                    от {{ $receipt->date->format('d.m.Y') }}
                </small>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('receipts.edit', $receipt) }}" class="btn btn-outline-primary btn-sm">
                    Изменить
                </a>
                <a href="{{ route('receipts.index') }}" class="btn btn-outline-secondary btn-sm">
                    К списку
                </a>
            </div>
        </div>

        {{-- Общая информация --}}
        <div class="card mb-3">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="text-muted small">Тип</div>
                        <div>{{ $receipt->type->label() }}</div>
                    </div>

                    <div class="col-md-4">
                        <div class="text-muted small">Контрагент</div>
                        <div>
                            <a href="{{ route('contractors.show', $receipt->contractor) }}">
                                {{ $receipt->contractor->name }}
                            </a>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="text-muted small">Статус</div>
                        <span class="badge {{ $receipt->status ? 'bg-success' : 'bg-secondary' }}">
                        {{ $receipt->status ? 'Активный' : 'Не активный' }}
                    </span>
                    </div>

                    <div class="col-md-4">
                        <div class="text-muted small">Входящий документ</div>
                        <div>
                            {{ $receipt->document_number ?? '—' }}
                            @if($receipt->document_date)
                                от {{ $receipt->document_date->format('d.m.Y') }}
                            @endif
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="text-muted small">Примечание</div>
                        <div>{{ $receipt->note ?: '—' }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Вкладки --}}
        <ul class="nav nav-tabs mb-3" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#items">
                    Строки поступления
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#totals">
                    Итоги
                </button>
            </li>
        </ul>

        <div class="tab-content">

            {{-- Таблица строк --}}
            <div class="tab-pane fade show active" id="items">
                <div class="card">
                    <div class="card-body p-0">
                        <table class="table table-striped mb-0 align-middle">
                            <thead class="table-light">
                            <tr>
                                <th>Наименование</th>
                                <th class="text-end">Кол-во</th>
                                <th class="text-end">Цена</th>
                                <th class="text-end">Сумма</th>
                                <th class="text-end">НДС</th>
                                <th class="text-end">Итого</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($receipt->items as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td class="text-end">{{ $item->quantity }}</td>
                                    <td class="text-end">{{ number_format($item->price, 2, ',', ' ') }}</td>
                                    <td class="text-end">{{ number_format($item->amount, 2, ',', ' ') }}</td>
                                    <td class="text-end">
                                        {{ number_format($item->vat_amount, 2, ',', ' ') }}
                                        <span class="text-muted small">
                                        ({{ $item->vat->rate }}%)
                                    </span>
                                    </td>
                                    <td class="text-end">{{ number_format($item->total_amount, 2, ',', ' ') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Итоги --}}
            <div class="tab-pane fade" id="totals">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="text-muted small">Итого без НДС</div>
                                <div class="fw-bold">
                                    {{ number_format($receipt->total_amount - $receipt->total_vat, 2, ',', ' ') }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-muted small">Итого НДС</div>
                                <div class="fw-bold">
                                    {{ number_format($receipt->total_vat, 2, ',', ' ') }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-muted small">Итого с НДС</div>
                                <div class="fw-bold fs-5">
                                    {{ number_format($receipt->total_amount, 2, ',', ' ') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
