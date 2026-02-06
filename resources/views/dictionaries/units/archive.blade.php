@extends('layouts.app')

@section('title','Архив единиц')

@section('content')

    <div class="d-flex justify-content-between mb-3">
        <h4>Архив единиц измерения</h4>

        <a href="{{ route('units.index') }}"
           class="btn btn-outline-primary">
            Назад
        </a>
    </div>

    <table class="table table-striped align-middle mb-0">
        <thead>
        <tr>
            <th>Название</th>
            <th>Сокр.</th>
            <th>Код</th>
            <th style="width: 150px">Действие</th>
        </tr>
        </thead>

        <tbody>
        @forelse($units as $unit)
            <tr>
                <td>{{ $unit->name }}</td>
                <td>{{ $unit->short_name }}</td>
                <td>{{ $unit->code }}</td>

                <td class="text-end text-nowrap">

                    {{-- Restore --}}
                    <form method="POST"
                          action="{{ route('units.restore',$unit->id) }}"
                          class="d-inline">

                        @csrf

                        <button class="btn btn-sm btn-success">
                            ♻
                        </button>
                    </form>

                    {{-- Force delete --}}
                    <form method="POST"
                          action="{{ route('units.force-delete',$unit->id) }}"
                          class="d-inline"
                          onsubmit="return confirm('Удалить навсегда?')">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-sm btn-danger">
                            🗑
                        </button>
                    </form>

                </td>
            </tr>

        @empty
            <tr>
                <td colspan="4" class="text-center">
                    Архив пуст
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

@endsection
