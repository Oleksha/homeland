@extends('layouts.app')

@section('title','Категории номенклатуры')

@section('content')

    <div class="d-flex justify-content-between mb-3">
        <h4>Категории номенклатуры</h4>

        <div>
            <a href="{{ route('categories.archive') }}"
               class="btn btn-outline-secondary">
                Архив
            </a>
            <a href="{{ route('categories.create') }}" class="btn btn-primary">
                Добавить
            </a>
        </div>

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
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->parent?->name }}</td>

                <td class="text-end text-nowrap">
                    <a href="{{ route('categories.edit', $category) }}"
                       class="btn btn-sm btn-outline-primary">
                        ✏️
                    </a>

                    <form method="post"
                          action="{{ route('categories.destroy', $category) }}"
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

@endsection
