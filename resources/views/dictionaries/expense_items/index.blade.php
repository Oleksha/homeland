@extends('layouts.app')

@section('title', 'Статьи расхода')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Статьи расхода</h4>
        <div>
            <a href="{{ route('expense-items.archive') }}"
               class="btn btn-outline-secondary me-1">
                Архив
            </a>
            <a href="{{ route('expense-items.create') }}"
               class="btn btn-primary">
                + Добавить
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped align-middle mb-0">
            <thead>
            <tr>
                <th style="width: 60px">ID</th>
                <th>Наименование</th>
                <th style="width: 250px">Используется в отчетах</th>
                <th style="width: 160px"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td class="fw-semibold">{{ $item->name }}</td>
                    <td>
                        @if($item->is_report_selection)
                            <span class="badge bg-success">Да</span>
                        @else
                            <span class="text-muted">Нет</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('expense-items.edit', $item) }}"
                               class="btn btn-outline-primary me-2">
                                Изменить
                            </a>
                            <form method="POST"
                                  action="{{ route('expense-items.destroy', $item) }}"
                                  onsubmit="return confirm('Переместить в архив?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-warning">Удалить</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4"
                        class="text-center text-muted py-4">
                        Нет данных
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    @if($items->hasPages())
        <div class="mt-3">{{ $items->links() }}</div>
    @endif

@endsection
