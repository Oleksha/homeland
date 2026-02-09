@extends('layouts.app')

@section('title','Архив категорий')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h4>Архив категорий номенклатуры</h4>

        <a href="{{ route('categories.index') }}"
           class="btn btn-outline-primary">
            Назад
        </a>
    </div>

    <table class="table table-striped align-middle mb-0">
        <thead>
        <tr>
            <th>Название</th>
            <th>Родитель</th>
            <th style="width: 150px">Действие</th>
        </tr>
        </thead>

        <tbody>
        @forelse($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->parent?->name }}</td>
                <td class="text-end text-nowrap">
                    {{-- Restore --}}
                    <form method="post" class="d-inline"
                          action="{{ route('categories.restore', $category->id) }}">
                        @csrf
                        <button class="btn btn-sm btn-success">
                            ♻
                        </button>
                    </form>

                    {{-- Force delete --}}
                    <form method="POST"
                          action="{{ route('categories.force-delete',$category->id) }}"
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
