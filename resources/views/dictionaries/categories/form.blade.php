@extends('layouts.app')

@section('title')
    {{ isset($category) ? 'Редактирование категории' : 'Создание категории' }}
@endsection

@section('content')

    <div class="container">

        {{-- Заголовок --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">
                {{ isset($category) ? 'Редактирование категории' : 'Создание категории' }}
            </h4>

            <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
                Назад
            </a>
        </div>

        {{-- Ошибки --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Форма --}}
        <form method="POST"
              action="{{ isset($category)
                ? route('categories.update', $category)
                : route('categories.store') }}"
              class="was-validated">

            @csrf
            @isset($category)
                @method('PUT')
            @endisset

            <div class="row">

                {{-- Наименование --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">
                        Название категории
                    </label>

                    <input type="text"
                           name="name"
                           class="form-control form-control-sm"
                           value="{{ old('name', $category->name ?? '') }}"
                           required>

                    <div class="invalid-feedback">
                        Укажите название категории
                    </div>
                </div>

                {{-- Родительская категория --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">
                        Родительская категория
                    </label>

                    <select name="parent_id"
                            class="form-select form-select-sm">

                        <option value="">
                            — Без родительской категории —
                        </option>

                        @foreach($categories as $parent)
                            <option value="{{ $parent->id }}"
                                @selected(old('parent_id', $category->parent_id ?? null) == $parent->id)>
                                {{ $parent->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

            </div>

            {{-- Кнопки --}}
            <div class="mt-3">
                <button class="btn btn-primary">
                    {{ isset($category) ? 'Сохранить' : 'Создать' }}
                </button>

                <a href="{{ route('categories.index') }}"
                   class="btn btn-outline-secondary">
                    Отмена
                </a>
            </div>

        </form>

    </div>

@endsection
