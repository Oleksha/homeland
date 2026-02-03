@extends('layouts.app')

@section('title', isset($authorization)
    ? 'Изменение разрешения'
    : 'Добавление разрешения')

@section('content')

    <div class="container">

        <h4 class="mb-3">
            {{ isset($authorization)
                ? 'Изменение разрешения'
                : 'Добавление разрешения' }}
        </h4>

        <form method="POST"
              action="{{ isset($authorization)
              ? route('payment-authorizations.update', $authorization)
              : route('payment-authorizations.store') }}">

            @csrf
            @isset($authorization)
                @method('PUT')
            @endisset

            <div class="card">
                <div class="card-body">

                    {{-- Контрагент --}}
                    <div class="mb-3">
                        <label class="form-label">Контрагент</label>

                        <select name="contractor_id" class="form-select" required>
                            <option value="">Выберите</option>

                            @foreach($contractors as $contractor)
                                <option value="{{ $contractor->id }}"
                                    @selected(old('contractor_id',
                                        $authorization->contractor_id ?? '') == $contractor->id)>
                                    {{ $contractor->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Статья расхода --}}
                    <div class="mb-3">
                        <label class="form-label">Статья расхода</label>

                        <select name="expense_item_id"
                                class="form-select"
                                required>

                            <option value="">Выберите</option>

                            @foreach($expenseItems as $item)
                                <option value="{{ $item->id }}"
                                    @selected(old('expense_item_id',
                                        $authorization->expense_item_id ?? '') == $item->id)>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Номер --}}
                    <div class="mb-3">
                        <label class="form-label">Номер</label>

                        <input type="text"
                               name="number"
                               class="form-control"
                               value="{{ old('number', $authorization->number ?? '') }}"
                               required>
                    </div>

                    <div class="row">

                        {{-- Дата начала --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Дата начала</label>

                            <input type="date"
                                   name="date_start"
                                   class="form-control"
                                   value="{{ old('date_start',
                                   optional($authorization->date_start ?? null)->format('Y-m-d')) }}"
                                   required>
                        </div>

                        {{-- Дата окончания --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Дата окончания</label>

                            <input type="date"
                                   name="date_end"
                                   class="form-control"
                                   value="{{ old('date_end',
                                   optional($authorization->date_end ?? null)->format('Y-m-d')) }}">
                        </div>

                        {{-- Отсрочка --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Отсрочка (дней)</label>

                            <input type="number"
                                   name="delay"
                                   class="form-control"
                                   value="{{ old('delay', $authorization->delay ?? 0) }}">
                        </div>

                    </div>

                    {{-- Сумма --}}
                    <div class="mb-3">
                        <label class="form-label">Сумма без НДС</label>

                        <input type="number"
                               step="0.01"
                               name="amount"
                               class="form-control"
                               value="{{ old('amount', $authorization->amount ?? '') }}"
                               required>
                    </div>

                </div>

                <div class="card-footer text-end">

                    <a href="{{ route('payment-authorizations.index') }}"
                       class="btn btn-secondary">
                        Назад
                    </a>

                    <button class="btn btn-success">
                        Сохранить
                    </button>

                </div>
            </div>

        </form>

    </div>

@endsection
