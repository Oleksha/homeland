@extends('layouts.app')

@section('title', 'Архив поступлений')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Архив поступлений</h1>

            <a href="{{ route('receipts.index') }}" class="btn btn-outline-secondary">
                Назад
            </a>
        </div>

        <table class="table table-striped align-middle">
            <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Дата</th>
                <th>Номер</th>
                <th>Контрагент</th>
                <th>Сумма</th>
                <th>Сумма НДС</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @forelse($receipts as $receipt)
                <tr>
                    <td>{{ $receipt->id }}</td>
                    <td>{{ optional($receipt->date)->format('Y-m-d') }}</td>
                    <td>{{ $receipt->number }}</td>
                    <td>{{ $receipt->contractor->name ?? '-' }}</td>
                    <td>{{ number_format($receipt->total_amount, 2) }}</td>
                    <td>{{ number_format($receipt->total_vat, 2) }}</td>
                    <td>
                        <form action="{{ route('receipts.restore', $receipt->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-success">
                                Восстановить
                            </button>
                        </form>

                        <form action="{{ route('receipts.forceDelete', $receipt->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Удалить окончательно?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Архив пуст</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
