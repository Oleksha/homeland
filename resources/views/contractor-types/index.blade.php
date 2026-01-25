@extends('layouts.app')

@section('title', 'Типы контрагентов')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4">Типы контрагентов</h1>
        <a href="{{ route('contractor-types.create') }}" class="btn btn-primary">
            + Добавить
        </a>
    </div>

    <table class="table table-striped align-middle">
        <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th class="text-end">Действия</th>
        </tr>
        </thead>
        <tbody>
        @forelse($types as $type)
            <tr>
                <td>{{ $type->id }}</td>
                <td>{{ $type->name }}</td>
                <td class="text-end">
                    <a
                        href="{{ route('contractor-types.edit', $type) }}"
                        class="btn btn-sm btn-outline-primary"
                    >✏️</a>

                    <form
                        action="{{ route('contractor-types.destroy', $type) }}"
                        method="POST"
                        class="d-inline"
                        onsubmit="return confirm('Удалить?')"
                    >
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">🗑</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center text-muted py-4">
                    Типы контрагентов не найдены
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
