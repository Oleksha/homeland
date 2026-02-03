@extends('layouts.app')

@section('title', 'Архив разрешений на оплату')

@section('content')
    <main class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Архив разрешений на оплату</h5>

            <a href="{{ route('payment-authorizations.index') }}"
               class="btn btn-outline-primary">
                ← Назад
            </a>
        </div>

        <table class="table table-striped align-middle mb-0">
            <thead>
            <tr>
                <th>ID</th>
                <th>Контрагент</th>
                <th>Статья расхода</th>
                <th>Номер</th>
                <th>Дата начала</th>
                <th>Дата окончания</th>
                <th>Отсрочка</th>
                <th>Сумма</th>
                <th width="180">Действия</th>
            </tr>
            </thead>

            <tbody>

            @forelse($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>

                    <td>
                        <a href="{{ route('contractors.show', $item->contractor->id) }}">
                            {{ $item->contractor->name ?? '—' }}
                        </a>
                    </td>

                    <td>
                        {{ $item->expenseItem?->name ?? '—' }}
                    </td>

                    <td>{{ $item->number }}</td>

                    <td>{{ optional($item->date_start)->format('d.m.Y') }}</td>

                    <td>{{ optional($item->date_end)->format('d.m.Y') }}</td>

                    <td>
                        {{ $item->delay ? $item->delay.' дн.' : '—' }}
                    </td>

                    <td class="text-end">
                        {{ number_format($item->amount, 2, ',', ' ') }}
                    </td>

                    <td class="text-center">

                        {{-- Restore --}}
                        <form method="POST"
                              action="{{ route('payment-authorizations.restore', $item->id) }}"
                              class="d-inline">
                            @csrf

                            <button class="btn btn-sm btn-success"
                                    onclick="return confirm('Восстановить запись?')">
                                ♻
                            </button>
                        </form>

                        {{-- Force delete --}}
                        <form method="POST"
                              action="{{ route('payment-authorizations.force', $item->id) }}"
                              class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Удалить окончательно?')">
                                🗑
                            </button>
                        </form>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center text-muted py-4">
                        Архив пуст
                    </td>
                </tr>
            @endforelse

            </tbody>
        </table>

        {{-- Pagination --}}
        @if($items->hasPages())
            <div>{{ $items->links() }}</div>
        @endif

    </main>
@endsection
