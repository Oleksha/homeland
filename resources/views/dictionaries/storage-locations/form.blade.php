@extends('layouts.app')

@section('title')
    {{ isset($storageLocation) 
        ? 'Редактирование места хранения' 
        : 'Создание места хранения' }}
@endsection

@section('content')

    <form method="post"
          action="{{ isset($storageLocation)
              ? route('storage-locations.update', $storageLocation)
              : route('storage-locations.store') }}">

        @csrf
        @isset($storageLocation)
            @method('PUT')
        @endisset

        <div class="mb-3">
            <label class="form-label">Наименование</label>
            <input type="text"
                   name="name"
                   class="form-control"
                   value="{{ old('name', $storageLocation->name ?? '') }}"
                   required>
        </div>

        <button class="btn btn-success">Сохранить</button>
    </form>

@endsection
