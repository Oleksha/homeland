@extends('layouts.app')

@section('title', $type->exists ? 'Редактирование типа' : 'Добавление типа')

@section('content')
    <h1 class="h4 mb-3">
        {{ $type->exists ? 'Редактирование типа контрагента' : 'Добавление типа контрагента' }}
    </h1>

    <form
        method="POST"
        action="{{ $type->exists
        ? route('contractor-types.update', $type)
        : route('contractor-types.store') }}"
        class="card card-body"
    >
        @csrf
        @if($type->exists)
            @method('PUT')
        @endif

        <div class="mb-3">
            <label class="form-label">Название</label>
            <input
                type="text"
                name="name"
                class="form-control"
                value="{{ old('name', $type->name) }}"
                required
            >
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-primary">Сохранить</button>
            <a href="{{ route('contractor-types.index') }}" class="btn btn-secondary">
                Отмена
            </a>
        </div>
    </form>
@endsection
