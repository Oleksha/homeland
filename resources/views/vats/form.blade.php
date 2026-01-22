@extends('layouts.app')

@section('title', $vat->exists ? 'Редактирование НДС' : 'Добавление НДС')

@section('content')
    <h1 class="h4 mb-3">
        {{ $vat->exists ? 'Редактирование НДС' : 'Добавление НДС' }}
    </h1>

    <form
        method="POST"
        action="{{ $vat->exists ? route('vats.update', $vat) : route('vats.store') }}"
        class="card card-body"
    >
        @csrf
        @if($vat->exists)
            @method('PUT')
        @endif

        <div class="mb-3">
            <label class="form-label">Название</label>
            <input
                type="text"
                name="name"
                class="form-control"
                value="{{ old('name', $vat->name) }}"
                required
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Ставка (%)</label>
            <input
                type="number"
                step="0.01"
                name="rate"
                class="form-control"
                value="{{ old('rate', $vat->rate) }}"
                required
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Код</label>
            <input
                type="text"
                name="code"
                class="form-control"
                value="{{ old('code', $vat->code) }}"
            >
        </div>

        <div class="form-check mb-2">
            <input
                class="form-check-input"
                type="checkbox"
                name="is_active"
                value="1"
                {{ old('is_active', $vat->is_active ?? true) ? 'checked' : '' }}
            >
            <label class="form-check-label">
                Активен
            </label>
        </div>

        <div class="form-check mb-3">
            <input
                class="form-check-input"
                type="checkbox"
                name="is_default"
                value="1"
                {{ old('is_default', $vat->is_default) ? 'checked' : '' }}
            >
            <label class="form-check-label">
                По умолчанию
            </label>
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-primary">Сохранить</button>
            <a href="{{ route('vats.index') }}" class="btn btn-secondary">
                Отмена
            </a>
        </div>
    </form>
@endsection
