@extends('layouts.app')

@section('title', 'Бюджет')

@section('content')
    <div class="container-fluid">

        {{-- Заголовок --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Бюджет</h1>

            <div class="d-flex gap-2">
                <a href="{{ route('budgets.create') }}" class="btn btn-primary">
                    + Новая операция
                </a>

                <button
                    class="btn btn-outline-success"
                    data-bs-toggle="modal"
                    data-bs-target="#importBudgetModal"
                >
                    📥 Импорт из Excel
                </button>
            </div>
        </div>

        {{-- Фильтры --}}
        <div class="card mb-4">
            <div class="card-body">
                <form method="get" class="row g-3 align-items-end">

                    {{-- Период --}}
                    <div class="col-md-3">
                        <label class="form-label">Период</label>

                        <div class="input-group">

                            {{-- Предыдущий месяц --}}
                            <a href="{{ route('budgets.index', array_merge(request()->query(), [
                                'period' => \Carbon\Carbon::parse(
                                    $filters['period'] ?? session('budget_period', now()->format('Y-m'))
                                )->subMonth()->format('Y-m')
                                ])) }}"
                               class="btn btn-outline-secondary">
                                ←
                            </a>

                            {{-- Поле выбора месяца --}}
                            <input type="month"
                                   name="period"
                                   value="{{ $filters['period'] ?? session('budget_period', now()->format('Y-m')) }}"
                                   class="form-control">

                            {{-- Следующий месяц --}}
                            <a href="{{ route('budgets.index', array_merge(request()->query(), [
            'period' => \Carbon\Carbon::parse(
                $filters['period'] ?? session('budget_period', now()->format('Y-m'))
            )->addMonth()->format('Y-m')
        ])) }}"
                               class="btn btn-outline-secondary">
                                →
                            </a>

                        </div>
                    </div>


                    {{-- Архив --}}
                    <div class="col-md-6">
                        <div class="form-check mt-4">
                            {{-- важно для корректной передачи 0 --}}
                            <input type="hidden" name="archived" value="0">

                            <input
                                type="checkbox"
                                name="archived"
                                id="archived"
                                value="1"
                                class="form-check-input"
                                @checked(request()->boolean('archived'))
                            >

                            <label class="form-check-label" for="archived">
                                Показать архив
                            </label>
                        </div>
                    </div>

                    {{-- Кнопки --}}
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">
                            Применить
                        </button>

                        <a href="{{ route('budgets.index') }}" class="btn btn-outline-secondary w-100">
                            Сбросить
                        </a>
                    </div>

                </form>
            </div>
        </div>

        {{-- Таблица --}}
        <table class="table table-striped align-middle mb-0">
            <thead>
            <tr>
                <th>Период</th>
                <th>№</th>
                <th>Статья расхода</th>
                <th class="text-end">Сумма</th>
                <th>НДС</th>
                <th>Статус</th>
                <th class="text-end">Действия</th>
            </tr>
            </thead>

            <tbody>
            @forelse($budgets as $budget)
                <tr class="{{ $budget->trashed() ? 'table-secondary' : '' }}">
                    <td>
                        {{ $budget->budget_period->format('Y-m') }}
                    </td>

                    <td>
                        {{ $budget->budget_number }}
                    </td>

                    <td>
                        {{ $budget->expenseItem->name ?? '—' }}
                    </td>

                    <td class="text-end">
                        {{ number_format($budget->amount, 2, ',', ' ') }}
                    </td>

                    <td>
                        {{ $budget->vat->name ?? '—' }}
                    </td>

                    <td>
                                <span class="badge bg-{{ $budget->status->color() }}">
                                    {{ $budget->status->label() }}
                                </span>
                    </td>

                    <td class="text-end">
                        <div class="d-flex  justify-content-end">

                            <a href="{{ route('budgets.show', $budget) }}"
                               class="btn btn-outline-secondary">
                                👁
                            </a>

                            @unless($budget->trashed())
                                <a href="{{ route('budgets.edit', $budget) }}"
                                   class="btn btn-outline-primary ms-2">
                                    ✏️
                                </a>

                                <form method="post"
                                      action="{{ route('budgets.destroy', $budget) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger ms-2"
                                            onclick="return confirm('Удалить запись?')">
                                        🗑
                                    </button>
                                </form>
                            @else
                                <form method="post"
                                      action="{{ route('budgets.restore', $budget->id) }}">
                                    @csrf
                                    <button class="btn btn-outline-success ms-2">
                                        ♻
                                    </button>
                                </form>
                            @endunless

                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        Записей не найдено
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        {{-- Пагинация --}}
        @if($budgets->hasPages())
            <div class="mt-3">{{ $budgets->links() }}</div>
        @endif

    </div>
    {{-- Modal Import Budget --}}
    <div class="modal fade" id="importBudgetModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form method="POST"
                      action="{{ route('budgets.import') }}"
                      enctype="multipart/form-data">

                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">
                            Импорт бюджетных операций из Excel
                        </h5>

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        {{-- Файл --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                Выберите файл Excel
                            </label>

                            <input type="file"
                                   name="file"
                                   class="form-control"
                                   accept=".xlsx,.xls"
                                   required>

                            <div class="form-text">
                                Поддерживаются файлы .xlsx / .xls
                            </div>
                        </div>

                        {{-- Подсказка --}}
                        <div class="alert alert-info mb-0">
                            Формат файла должен соответствовать шаблону импорта.
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">
                            Отмена
                        </button>

                        <button type="submit"
                                class="btn btn-success">
                            Импортировать
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

@endsection
