@extends('layouts.app')

@section('title','Архив номенклатуры')

@section('content')

    <div class="d-flex justify-content-between mb-3">
        <h4>Архив номенклатуры</h4>

        <a href="{{ route('nomenclatures.index') }}"
           class="btn btn-outline-secondary">
            Назад
        </a>
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
        @forelse($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->category?->name }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->unit?->name }}</td>

                <td class="text-end text-nowrap">

                    {{-- Restore --}}
                    <form method="POST"
                          action="{{ route('nomenclatures.restore',$item->id) }}"
                          class="d-inline">
                        @csrf

                        <button class="btn btn-sm btn-success">
                            ♻
                        </button>
                    </form>


                    {{-- Force delete --}}
                    <form method="POST"
                          action="{{ route('nomenclatures.force-delete',$item->id) }}"
                          class="d-inline">
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
                <td colspan="5" class="text-center">
                    Архив пуст
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $items->links() }}

@endsection
