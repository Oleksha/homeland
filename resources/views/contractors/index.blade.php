@extends('layouts.app')

@section('title', 'Контрагенты')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Контрагенты</h4>

        <div>
            <a href="{{ route('contractors.archive') }}" class="btn btn-outline-secondary">
                Архив
            </a>
            <a href="{{ route('contractors.create') }}" class="btn btn-primary ms-2">
                + Добавить
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-0">

            <table class="table table-striped align-middle mb-0">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Наименование</th>
                    <th class="text-center">Тип</th>
                    <th class="text-center">Поставщик</th>
                    <th class="text-center">ИНН</th>
                    <th class="text-center">НДС</th>
                    <th class="text-center">Отсрочка</th>
                    <th class="text-end">Действия</th>
                </tr>
                </thead>

                <tbody>
                @forelse($contractors as $contractor)
                    <tr>
                        <td class="text-center">{{ $contractor->id }}</td>

                        <td>
                            <a href="{{ route('contractors.show', $contractor) }}">
                                <strong>{{ $contractor->name }}</strong>
                            </a>
                            @if($contractor->code)
                                <div class="text-muted small">
                                    {{ $contractor->code }}
                                </div>
                            @endif
                        </td>

                        <td class="text-center">
                        <span class="badge bg-secondary">
                            {{ $contractor->type->name }}
                        </span>
                        </td>

                        <td class="text-center">
                            @if($contractor->is_supplier)
                                <span class="badge bg-success">Да</span>
                            @else
                                <span class="badge bg-light text-muted">Нет</span>
                            @endif
                        </td>

                        <td class="text-center">
                            {{ $contractor->inn ?? '—' }}
                        </td>

                        <td class="text-center">
                            @if($contractor->vat)
                                {{ $contractor->vat->name }}
                            @else
                                <span class="text-muted">Без НДС</span>
                            @endif
                        </td>

                        <td class="text-center">
                            {{ $contractor->delay }} дн.
                        </td>

                        <td class="text-end">
                            <div class="d-flex justify-content-end">
                                <a
                                    href="{{ route('contractors.edit', $contractor) }}"
                                    class="btn btn-outline-primary btn-sm me-1"
                                    title="Редактировать"
                                >
                                    ✏️
                                </a>

                                <form
                                    method="POST"
                                    action="{{ route('contractors.destroy', $contractor) }}"
                                    onsubmit="return confirm('Переместить в архив?')"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="btn btn-outline-warning btn-sm"
                                        title="В архив"
                                    >
                                        🗑
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            Контрагенты не найдены
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

        </div>
    </div>

@endsection
