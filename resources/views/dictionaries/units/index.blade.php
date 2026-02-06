@extends('layouts.app')

@section('title','Единицы измерения')

@section('content')

    <div class="d-flex justify-content-between mb-3">
        <h4>Единицы измерения</h4>

        <div>
            <a href="{{ route('units.archive') }}"
               class="btn btn-outline-secondary">
                Архив
            </a>
            <a href="{{ route('units.create') }}" class="btn btn-primary">
                Добавить
            </a>
        </div>

    </div>

    <table class="table table-striped align-middle mb-0">
        <thead>
        <tr>
            <th>Название</th>
            <th>Сокр.</th>
            <th>Код</th>
            <th style="width: 200px">Действие</th>
        </tr>
        </thead>

        <tbody>
        @foreach($units as $unit)
            <tr>
                <td>{{ $unit->name }}</td>
                <td>{{ $unit->short_name }}</td>
                <td>{{ $unit->code }}</td>

                <td class="text-end text-nowrap">
                    <a href="{{ route('units.edit',$unit) }}"
                       class="btn btn-sm btn-outline-primary">
                        ✏️
                    </a>

                    <form action="{{ route('units.destroy', $unit) }}"
                          method="POST"
                          class="d-inline"
                          onsubmit="return confirm('Переместить запись в архив?')">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-sm btn-outline-warning">
                            🗑
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
