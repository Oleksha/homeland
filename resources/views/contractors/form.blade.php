@extends('layouts.app')

@section('title', $contractor->exists ? 'Редактирование контрагента' : 'Добавление контрагента')

@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                {{ $contractor->exists ? 'Редактирование контрагента' : 'Добавление контрагента' }}
            </h5>
        </div>

        <div class="card-body">
            <form
                method="POST"
                action="{{ $contractor->exists
                ? route('contractors.update', $contractor)
                : route('contractors.store') }}"
            >
                @csrf
                @if($contractor->exists)
                    @method('PUT')
                @endif

                {{-- Наименование --}}
                <div class="mb-3">
                    <label class="form-label">Наименование *</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $contractor->name) }}"
                        required
                    >
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Внутренний код --}}
                <div class="mb-3">
                    <label class="form-label">Внутренний код</label>
                    <input
                        type="text"
                        name="code"
                        class="form-control @error('code') is-invalid @enderror"
                        value="{{ old('code', $contractor->code) }}"
                    >
                    @error('code')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    {{-- Тип контрагента --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Тип контрагента *</label>
                        <select
                            name="type_id"
                            class="form-select @error('type_id') is-invalid @enderror"
                            required
                        >
                            <option value="">— выберите —</option>
                            @foreach($types as $type)
                                <option
                                    value="{{ $type->id }}"
                                    @selected(old('type_id', $contractor->type_id) == $type->id)
                                >
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('type_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- НДС по умолчанию --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">НДС по умолчанию</label>
                        <select
                            name="vat_id"
                            class="form-select @error('vat_id') is-invalid @enderror"
                        >
                            <option value="">— без НДС —</option>
                            @foreach($vats as $vat)
                                <option
                                    value="{{ $vat->id }}"
                                    @selected(old('vat_id', $contractor->vat_id) == $vat->id)
                                >
                                    {{ $vat->name }} ({{ $vat->rate }}%)
                                </option>
                            @endforeach
                        </select>
                        @error('vat_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Поставщик --}}
                <div class="form-check mb-3">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="is_supplier"
                        value="1"
                        id="is_supplier"
                        @checked(old('is_supplier', $contractor->is_supplier))
                    >
                    <label class="form-check-label" for="is_supplier">
                        Является поставщиком
                    </label>
                </div>

                <div class="row">
                    {{-- ИНН --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">ИНН</label>
                        <input
                            type="text"
                            name="inn"
                            class="form-control @error('inn') is-invalid @enderror"
                            value="{{ old('inn', $contractor->inn) }}"
                        >
                    </div>

                    {{-- КПП --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">КПП</label>
                        <input
                            type="text"
                            name="kpp"
                            class="form-control @error('kpp') is-invalid @enderror"
                            value="{{ old('kpp', $contractor->kpp) }}"
                        >
                    </div>

                    {{-- Отсрочка --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Отсрочка (дней)</label>
                        <input
                            type="number"
                            name="delay"
                            min="0"
                            class="form-control @error('delay') is-invalid @enderror"
                            value="{{ old('delay', $contractor->delay) }}"
                        >
                    </div>
                </div>

                {{-- Адрес --}}
                <div class="mb-3">
                    <label class="form-label">Юридический адрес</label>
                    <input
                        type="text"
                        name="address"
                        class="form-control @error('address') is-invalid @enderror"
                        value="{{ old('address', $contractor->address) }}"
                    >
                </div>

                <div class="row">
                    {{-- Телефон --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Телефон</label>
                        <input
                            type="text"
                            name="phone"
                            class="form-control @error('phone') is-invalid @enderror"
                            value="{{ old('phone', $contractor->phone) }}"
                        >
                    </div>

                    {{-- Email --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input
                            type="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $contractor->email) }}"
                        >
                    </div>
                </div>

                {{-- Кнопки --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('contractors.index') }}" class="btn btn-outline-secondary">
                        Назад
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Сохранить
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
