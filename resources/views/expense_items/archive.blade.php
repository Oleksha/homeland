@extends('layouts.app')

@section('title', 'Архив статей расхода')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Архив статей расхода</h4>
        <a href="{{ route('expense-items.index') }}"
           class="btn btn-outline-secondary">
            Назад
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped align-middle mb-0">
            <thead>
            <tr>
                <th>ID</th>
                <th>Наименование</th>
                <th>Удалено</th>
                <th style="width: 200px"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td class="fw-semibold">{{ $item->name }}</td>
                    <td class="text-muted">
                        {{ $item->deleted_at->format('d.m.Y H:i') }}
                    </td>
                    <td class="text-end">
                        <div class="d-flex justify-content-end">
                            <form method="POST"
                                  action="{{ route('expense-items.restore', $item->id) }}">
                                @csrf
                                <button class="btn btn-outline-success me-2">
                                    Восстановить
                                </button>
                            </form>
                            <form method="POST"
                                  action="{{ route('expense-items.force', $item->id) }}"
                                  onsubmit="return confirm('Удалить навсегда? Это действие нельзя отменить.')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger">
                                    Удалить
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4"
                        class="text-center text-muted py-4">
                        Архив пуст
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    @if($items->hasPages())
        <div>{{ $items->links() }}</div>
    @endif

@endsection
