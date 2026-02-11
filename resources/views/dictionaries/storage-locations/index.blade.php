@extends('layouts.app')

@section('title','Места хранения')

@section('content')

    <div class="d-flex justify-content-between mb-3">
        <h4>Места хранения</h4>

        <div>
            <a href="{{ route('storage-locations.archive') }}"
               class="btn btn-outline-secondary">
                Архив
            </a>
            <a href="{{ route('storage-locations.create') }}" class="btn btn-primary">
                Добавить
            </a>
        </div>

    </div>

    <table class="table table-striped align-middle mb-3">
        <thead>
        <tr>
            <th>Наименование</th>
            <th style="width: 150px">Действие</th>
        </tr>
        </thead>

        <tbody>
        @foreach($locations as $location)
            <tr>
                <td>{{ $location->name }}</td>

                <td class="text-end text-nowrap">
                    <a href="{{ route('storage-locations.edit', $location) }}"
                       class="btn btn-sm btn-outline-primary">
                        ✏️
                    </a>

                    <form method="post"
                          action="{{ route('storage-locations.destroy', $location) }}"
                          class="d-inline">
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

    {{ $locations->links() }}

@endsection
