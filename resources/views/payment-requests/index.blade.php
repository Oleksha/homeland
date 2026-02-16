@extends('layouts.app')

@section('title', 'Заявки на оплату')

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Заявки на оплату</h1>

            <a href="{{ route('payment-requests.create') }}" class="btn btn-primary">
                + Новая заявка
            </a>
        </div>

        {{-- Фильтр --}}
        <div class="card mb-4">
            <div class="card-body">
                <form method="get" class="row g-3 align-items-end">

                    @php
                        $currentMonth = $filter->month;
                        $prevMonth = $currentMonth->subMonth()->format('Y-m');
                        $nextMonth = $currentMonth->addMonth()->format('Y-m');
                    @endphp
                    <div class="col-md-3">
                        <label class="form-label">Период</label>
                        <div class="input-group">

                        <a href="{{ route('payment-requests.index', array_merge(request()->except('month'), ['month' => $prevMonth])) }}"
                           class="btn btn-outline-secondary">
                            ←
                        </a>

                        {{-- Поле выбора месяца --}}
                        <input type="month"
                               name="period"
                               value="{{ $filters['period'] ?? now()->format('Y-m') }}"
                               class="form-control">

                        <a href="{{ route('payment-requests.index', array_merge(request()->except('month'), ['month' => $nextMonth])) }}"
                           class="btn btn-outline-secondary">
                            →
                        </a>

                    </div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Статус</label>
                        <select name="status" class="form-select">
                            <option value="">Все</option>
                            @foreach(\App\Domains\Payment\Enums\PaymentRequestStatus::cases() as $status)
                                <option
                                    value="{{ $status->value }}"
                                    @selected(request('status') === $status->value)
                                >
                                    {{ $status->label() }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <div class="form-check mt-4">
                            <input type="hidden" name="archived" value="0">

                            <input type="checkbox"
                                   name="archived"
                                   value="1"
                                   class="form-check-input"
                                @checked(request()->boolean('archived'))>

                            <label class="form-check-label">
                                Показать архив
                            </label>
                        </div>
                    </div>

                    <div class="col-md-3 d-flex gap-2">
                        <button class="btn btn-primary w-100">
                            Применить
                        </button>

                        <a href="{{ route('payment-requests.index') }}"
                           class="btn btn-outline-secondary w-100">
                            Сбросить
                        </a>
                    </div>

                </form>
            </div>
        </div>

        {{-- Таблица --}}
        <table class="table table-striped align-middle">
            <thead>
            <tr>
                <th>Дата</th>
                <th>№</th>
                <th>Контрагент</th>
                <th class="text-end">Сумма</th>
                <th>НДС</th>
                <th>Статус</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($paymentRequests as $request)
                <tr class="{{ $request->trashed() ? 'table-secondary' : '' }}">
                    <td>{{ $request->date?->format('d.m.Y') }}</td>
                    <td>{{ $request->number }}</td>
                    <td>{{ $request->contractor->name ?? '—' }}</td>
                    <td class="text-end">
                        {{ number_format($request->amount, 2, ',', ' ') }}
                    </td>
                    <td>{{ $request->vat->name ?? '—' }}</td>
                    <td>
                    <span class="badge bg-{{ $request->status->color() }}">
                        {{ $request->status->label() }}
                    </span>
                    </td>
                    <td class="text-end">
                        👁 ✏ 🗑
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        Записей нет
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        @if($paymentRequests->hasPages())
            <div class="mt-3">
                {{ $paymentRequests->links() }}
            </div>
        @endif

    </div>
@endsection
