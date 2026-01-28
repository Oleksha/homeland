@extends('layouts.app')

@section('title', 'Поступления')

@section('content')
    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Поступления</h4>

            <div>
                <a href="{{ route('receipts.archive') }}" class="btn btn-outline-secondary">
                    Архив
                </a>
                <a href="{{ route('receipts.create') }}" class="btn btn-primary">
                    + Добавить поступление
                </a>
            </div>
        </div>

        <table class="table table-striped align-middle mb-0">
            <thead>
            <tr>
                <th>Дата</th>
                <th>Номер</th>
                <th>Тип</th>
                <th>Контрагент</th>
                <th class="text-end">Сумма</th>
                <th class="text-end">НДС</th>
                <th class="text-center">Статус</th>
                <th class="text-end"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($receipts as $receipt)
                <tr>
                    <td>{{ $receipt->date->format('d.m.Y') }}</td>
                    <td>
                        <a href="{{ route('receipts.show', $receipt) }}">
                            <strong>{{ $receipt->number }}</strong>
                        </a>
                    </td>
                    <td>{{ $receipt->type->label() }}</td>
                    <td>
                        <a href="{{ route('contractors.show', $receipt->contractor_id) }}">
                            {{ $receipt->contractor->name }}
                        </a>
                    </td>
                    <td class="text-end">{{ number_format($receipt->total_amount, 2, ',', ' ') }}</td>
                    <td class="text-end">{{ number_format($receipt->total_vat, 2, ',', ' ') }}</td>
                    <td class="text-center">
                            <span class="badge {{ $receipt->status ? 'bg-success' : 'bg-secondary' }}">
                                {{ $receipt->status ? 'Активный' : 'Не активный' }}
                            </span>
                    </td>
                    <td class="text-end">
                        <a href="{{ route('receipts.edit', $receipt) }}" class="btn btn-sm btn-outline-primary">
                            ✏️
                        </a>
                        <form action="{{ route('receipts.destroy', $receipt) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Вы уверены, что хотите переместить поступление в архив?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-warning">
                                🗑
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">
                        Поступлений пока нет
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $receipts->links() }}
        </div>
    </div>
@endsection

