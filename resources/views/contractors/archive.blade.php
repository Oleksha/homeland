@extends('layouts.app')

@section('title', 'Архив контрагентов')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Архив контрагентов</h4>

        <a href="{{ route('contractors.index') }}" class="btn btn-outline-secondary">
            Назад
        </a>
    </div>

    <table class="table table-striped align-middle mb-0">
        <thead>
        <tr>
            <th>Наименование</th>
            <th>Тип</th>
            <th>Удалён</th>
            <th class="text-end">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($contractors as $contractor)
            <tr>
                <td>{{ $contractor->name }}</td>
                <td>{{ $contractor->type->name }}</td>
                <td>{{ $contractor->deleted_at->format('d.m.Y') }}</td>
                <td class="text-end">
                    <form
                        method="POST"
                        action="{{ route('contractors.restore', $contractor->id) }}"
                        class="d-inline"
                    >
                        @csrf
                        <button class="btn btn-success btn-sm">
                            Восстановить
                        </button>
                    </form>

                    <form
                        method="POST"
                        action="{{ route('contractors.forceDelete', $contractor->id) }}"
                        class="d-inline"
                        onsubmit="return confirm('Удалить навсегда?')"
                    >
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            Удалить
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
