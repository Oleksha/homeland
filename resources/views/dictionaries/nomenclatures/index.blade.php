@extends('layouts.app')

@section('title','Номенклатура')

@section('content')

    <div class="d-flex justify-content-between mb-3">
        <h4>Номенклатура</h4>

        <div>
            <a href="{{ route('nomenclatures.archive') }}" class="btn btn-outline-secondary">
                Архив
            </a>

            <a href="{{ route('nomenclatures.create') }}" class="btn btn-primary">
                Добавить
            </a>
        </div>
    </div>

    <table class="table table-striped align-middle mb-0">
        <thead>
        <tr>
            <th>ID</th>
            <th>Категория</th>
            <th>Название</th>
            <th>Ед.изм</th>
            <th style="width: 150px">Действие</th>
        </tr>
        </thead>

        <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->category?->name }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->unit?->name }}</td>

                <td class="text-end text-nowrap">

                    <a href="{{ route('nomenclatures.edit',$item) }}"
                       class="btn btn-sm btn-outline-primary">
                        ✏️
                    </a>

                    <form method="POST"
                          action="{{ route('nomenclatures.destroy',$item) }}"
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

    {{ $items->links() }}

@endsection
