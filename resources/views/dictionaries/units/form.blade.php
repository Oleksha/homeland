@extends('layouts.app')

@section('content')

    <form method="POST"
          action="{{ isset($unit)
          ? route('units.update',$unit)
          : route('units.store') }}">

        @csrf
        @isset($unit)
            @method('PUT')
        @endisset

        <div class="mb-3">
            <label class="form-label">Название</label>
            <input name="name"
                   class="form-control"
                   value="{{ old('name',$unit->name ?? '') }}"
                   required>
        </div>

        <div class="mb-3">
            <label>Сокращение</label>
            <input name="short_name"
                   class="form-control"
                   value="{{ old('short_name',$unit->short_name ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Код</label>
            <input name="code"
                   class="form-control"
                   value="{{ old('code',$unit->code ?? '') }}">
        </div>

        <div class="form-check mb-3">
            <input type="checkbox"
                   name="is_active"
                   value="1"
                   class="form-check-input"
                {{ old('is_active',$unit->is_active ?? true) ? 'checked' : '' }}>

            <label class="form-check-label">
                Активна
            </label>
        </div>

        <button class="btn btn-success">Сохранить</button>

    </form>

@endsection
