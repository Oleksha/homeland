@extends('layouts.app')

@section('title','Номенклатура')

@section('content')

    <h4 class="mb-3">
        {{ $nomenclature->exists ? 'Редактирование' : 'Создание' }}
    </h4>

    <form method="POST"
          action="{{ $nomenclature->exists
            ? route('nomenclatures.update',$nomenclature)
            : route('nomenclatures.store') }}">

        @csrf
        @if($nomenclature->exists)
            @method('PUT')
        @endif


        {{-- Категория --}}
        <div class="mb-3">
            <label class="form-label">Категория</label>

            <select name="category_id" class="form-select" required>
                <option value="">---</option>

                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        @selected(old('category_id',$nomenclature->category_id)==$category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>


        {{-- Название --}}
        <div class="mb-3">
            <label class="form-label">Название</label>

            <input type="text"
                   name="name"
                   class="form-control"
                   value="{{ old('name',$nomenclature->name) }}"
                   required>
        </div>


        {{-- Ед измерения --}}
        <div class="mb-3">
            <label class="form-label">Ед. измерения</label>

            <select name="unit_id" class="form-select" required>
                <option value="">---</option>

                @foreach($units as $unit)
                    <option value="{{ $unit->id }}"
                        @selected(old('unit_id',$nomenclature->unit_id)==$unit->id)>
                        {{ $unit->name }}
                    </option>
                @endforeach
            </select>
        </div>


        {{-- Описание --}}
        <div class="mb-3">
            <label class="form-label">Описание</label>

            <textarea name="description"
                      class="form-control"
                      rows="3">{{ old('description',$nomenclature->description) }}</textarea>
        </div>


        <button class="btn btn-success">Сохранить</button>

        <a href="{{ route('nomenclatures.index') }}"
           class="btn btn-secondary">
            Назад
        </a>

    </form>

@endsection
