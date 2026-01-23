@extends('layouts.app')

@section('title', 'Ставки НДС')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Ставки НДС</h1>
        <a href="{{ route('vats.create') }}" class="btn btn-primary">
            + Добавить
        </a>
    </div>

    <table class="table table-striped align-middle">
        <thead>
        <tr>
            <th>Название</th>
            <th class="text-end">Ставка</th>
            <th class="text-center">По умолчанию</th>
            <th class="text-end">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($vats as $vat)
            <tr>
                <td class="align-middle">{{ $vat->name }}</td>
                <td class="text-end align-middle">{{ $vat->rate }}%</td>
                <td class="text-center align-middle">
                    @if($vat->is_default)
                        <span class="badge bg-success">Да</span>
                    @endif
                </td>
                <td class="text-end align-middle">
                    <a
                        href="{{ route('vats.edit', $vat) }}"
                        class="btn btn-sm btn-outline-primary"
                    >
                        ✏️
                    </a>

                    <form
                        method="POST"
                        action="{{ route('vats.destroy', $vat) }}"
                        class="d-inline"
                        onsubmit="return confirm('Удалить?')"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            class="btn btn-sm btn-outline-danger"
                            {{ $vat->is_default ? 'disabled' : '' }}
                        >
                            🗑
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
